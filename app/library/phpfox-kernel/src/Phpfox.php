<?php

namespace {

    use Phpfox\Cache\StorageInterface;
    use Phpfox\Kernel\Event;
    use Phpfox\Kernel\ItemInterface;
    use Phpfox\Kernel\ParameterContainer;
    use Phpfox\Kernel\Parameters;
    use Phpfox\Kernel\ServiceContainer;
    use Phpfox\Kernel\UserInterface;

    /**
     * @codeCoverageIgnore
     */
    class Phpfox
    {
        /**
         * @var \Phpfox\Kernel\ServiceContainer
         */
        private static $service;

        /**
         * @var \Phpfox\Kernel\ParameterContainer
         */
        private static $parameter;

        /**
         * @var bool
         */
        private static $initialized = false;

        /**
         * Initialize method
         */
        public static function init()
        {
            if (self::$initialized) {
                return;
            }

            self::$initialized = true;

            $autoloadCacheFile = PHPFOX_CACHE_DIR . '_autoload.library.php';
            $packageCacheFile = PHPFOX_CACHE_DIR . '_parameters.library.php';

            $rebuild = PHPFOX_ENV == 'development';

            if (!file_exists($autoloadCacheFile)
                OR !file_exists($packageCacheFile)
            ) {
                $rebuild = true;
            }

            if ($rebuild) {
                self::buildLibraryFiles($autoloadCacheFile, $packageCacheFile);
            }

            /**
             *  STEP 01: INIT MINIMUM PACKAGES ENVIRONMENT
             *
             *  + Setup autoload (minimum)
             *  + Register autoload (minimum)
             *  + Create require services (minimum)
             *  + Setup parameters (minimum)
             *  + Init package loader
             */
            self::addPsr4($autoloadCacheFile);

            // Create require services (minimum)
            self::$service = new ServiceContainer();

            /** @noinspection PhpIncludeInspection */
            // Setup parameters (minimum)
            self::$parameter = new ParameterContainer(include $packageCacheFile);

            $loader = self::get('package.loader');

            /**
             * STEP 02: INIT ALL PACKAGE ENVIRONMENT
             * + Register autoload (all)
             * + Setup parameters (all)
             */

            // Register autoload (all)
            self::addPsr4($loader->getAutoloadParameters());

            // Setup parameters (all)
            self::$parameter->setData($loader->getPackageParameters());

            /**
             *  STEP 03: INIT SYSTEM REQUIRED SERVICES
             *
             * + Resolve conflict version of bootstrap cache & shared cache (via core.setting_version)
             * + Register error handler
             */

            // init event dispatcher
            self::get('mvc.events')->initialize();

            // register error handler
            self::get('error.handler')->register();

            /**
             * STEP 04. NOTIFY EVENTS
             *
             * + Emit event `onStart`
             * + Emit event `onReady`
             * + Emit event `onShutdown`
             */

            self::trigger('onStart');

            self::trigger('onReady');
        }

        /**
         * @see ServiceContainer::get()
         *
         * @param string $name
         *
         * @return mixed
         */
        public static function get($name)
        {
            return static::$service->get($name);
        }

        /**
         * @see ServiceContainer::has()
         *
         * @param string $name
         *
         * @return bool
         */
        public static function has($name)
        {
            return static::$service->has($name);
        }

        /**
         * @see GatewayManager::get()
         *
         * @param string $name
         *
         * @return \Phpfox\Model\GatewayInterface|\Phpfox\Db\DbTableGateway
         */
        public static function model($name)
        {
            return static::$service->get('models')->get($name);
        }

        /**
         * @see GatewayInterface::findById()
         *
         * @param string $type
         * @param mixed  $id
         *
         * @return \Phpfox\Model\ModelInterface
         */
        public static function find($type, $id)
        {
            return static::$service->get('models')->findById($type, $id);
        }

        /**
         * Load from cache
         *
         * @param string  $cache
         * @param mixed   $key
         * @param int     $ttl
         * @param Closure $fallback
         *
         * @return mixed|object
         */
        public static function _try($cache, $key, $ttl, $fallback)
        {
            /** @var StorageInterface $cacheStorage */
            $cacheStorage = \Phpfox::$service->get($cache ? $cache : 'shared.cache');

            if (is_array($key)) {
                $key = implode('_', $key);
            }

            $item = $cacheStorage->get($key);

            if (null === $item) {
                $cacheStorage->set($key, $item = $fallback(), $ttl);
            }

            return $item;
        }

        /**
         * @param string $route
         * @param array  $params
         */
        public static function redirect($route, $params = [])
        {
            static::$service->get('response')->redirect(_url($route, $params));
        }


        /**
         * @see \Phpfox\Kernel\Configs::get()
         *
         * @param string $section
         * @param mixed  $item
         *
         * @return array
         */
        public static function param($section, $item = null)
        {
            return static::$parameter->get($section, $item);
        }

        /**
         * Use this method to get admin settings from `site_setting` value.
         *
         * @param string $key
         * @param mixed  $default
         *
         * @return mixed
         */
        public static function setting($key, $default = null)
        {
            return static::$parameter->setting($key, $default);
        }

        /**
         * @param string $name
         * @param mixed  $target
         * @param mixed  $params
         *
         * @return \Phpfox\Kernel\EventResponse
         */
        public static function trigger($name, $target = null, $params = [])
        {
            return self::get('mvc.events')->trigger(new Event($name, $target, $params));
        }

        /**
         * @param string $name
         * @param mixed  $target
         * @param mixed  $params
         *
         * @return \Phpfox\Kernel\EventResponse
         */
        public static function callback($name, $target = null, $params = [])
        {
            return self::get('mvc.events')
                ->triggerUntil(new Event($name, $target, $params))
                ->first();
        }

        /**
         * Check acl settings user can do `action`
         *
         * @param UserInterface $user
         * @param string        $action
         * @param mixed         $default
         *
         * @return mixed
         */
        public static function allow($user, $action, $default = false)
        {
            return self::$service->get('acl')->allow($user, $action, $default);
        }

        /**
         * @param UserInterface $user
         * @param ItemInterface $item
         * @param string        $action
         *
         * @return bool
         */
        public static function pass($user, $item, $action)
        {
            return self::$service->get('acl')->pass($user, $item, $action);
        }

        /**
         * Export files
         *
         * @param string $autoloadFilename
         * @param string $parameterFilename
         */
        public static function buildLibraryFiles($autoloadFilename, $parameterFilename)
        {

            $autoloadData = [];
            $parameters = [];

            /** @var SplFileInfo $directoryIterator */
            $directoryIterator
                = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PHPFOX_LIBRARY_DIR,
                RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            $autoloadChecker = 'config' . DS . 'autoload.php';
            $packageChecker = 'config' . DS . 'package.php';

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }
                $path = $entry->getPath() . '/' . $entry->getFilename();
                if (strpos($path, $autoloadChecker)) {
                    $array = load_config($path);
                    if (is_array($array)) {
                        foreach ($array as $namespace => $values) {
                            if (!$namespace) {
                                continue;
                            }
                            $autoloadData[$namespace] = $values;
                        }
                    }
                } elseif (strpos($path, $packageChecker)) {
                    $array = load_config($path);
                    if (is_array($array)) {
                        foreach ($array as $k => $v) {
                            if (!isset($parameters[$k])) {
                                $parameters[$k] = $v;
                            } elseif (is_array($v)) {
                                $parameters[$k] = array_merge($parameters[$k], $v);
                            } else {
                                $parameters[$k] = $v;
                            }
                        }
                    }
                }
            }

            ksort($autoloadData);
            ksort($parameters);

            $parameters['db.adapters']['default'] = load_config(PHPFOX_DATABASE_FILE);

            self::fileExports($autoloadData, $autoloadFilename);
            self::fileExports($parameters, $parameterFilename);
        }

        /**
         * @param $data
         * @param $filename
         */
        public static function fileExports(&$data, $filename)
        {
            $content = '<?php return ' . var_export($data, true) . ';';

            if (!is_dir($dir = dirname($filename)) && !@mkdir($dir, 0777, true)) {
                exit('Can not open ' . $dir . ' to write export');
            }

            if (file_exists($filename)) {
                @unlink($filename);
            }

            if (!file_put_contents($filename, $content)) {
                trigger_error('Unable to write settings to ' . $filename, E_USER_ERROR);
            }
            @chmod($filename, 0777);
        }


        public static function getAutoloader()
        {
            return include PHPFOX_APP_DIR . 'vendor/autoload.php';
        }

        /**
         * @param array|string $array
         */
        public static function addPsr4($array)
        {
            $autoloader = self::getAutoloader();

            if (is_string($array)) {
                $array = load_config($array);
            }

            if ($array instanceof Parameters) {
                foreach ($array->all() as $namespace => $paths) {
                    if (!$namespace) {
                        continue;
                    }
                    if (is_string($paths)) {
                        $autoloader->addPsr4($namespace . '\\', PHPFOX_APP_DIR . '/' . $paths);
                    } elseif (is_array($paths)) {
                        foreach ($paths as $path) {
                            $autoloader->addPsr4($namespace . '\\', PHPFOX_APP_DIR . '/' . $path);
                        }
                    }
                }
            } elseif (is_array($array)) {
                foreach ($array as $namespace => $paths) {
                    if (!$namespace) {
                        continue;
                    }
                    if (is_string($paths)) {
                        $autoloader->addPsr4($namespace . '\\', PHPFOX_APP_DIR . '/' . $paths);
                    } elseif (is_array($paths)) {
                        foreach ($paths as $path) {
                            $autoloader->addPsr4($namespace . '\\', PHPFOX_APP_DIR . '/' . $path);
                        }
                    }
                }
            }
        }
    }
}