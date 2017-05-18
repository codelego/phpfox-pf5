<?php

namespace {

    use Phpfox\Support\ParameterContainer;
    use Phpfox\Support\Parameters;
    use Phpfox\Support\ServiceContainer;

    /**
     * @codeCoverageIgnore
     */
    class Phpfox
    {
        /**
         * @var \Phpfox\Support\ServiceContainer
         */
        public static $service;

        /**
         * @var \Phpfox\Support\ParameterContainer
         */
        public static $params;

        /**
         * @var bool
         */
        public static $initialized = false;

        /**
         * Initialize method
         */
        public static function init()
        {
            if (self::$initialized) {
                return;
            }

            self::$initialized = true;

            $libraryFiles = [
                'autoload' => PHPFOX_CACHE_DIR . '_autoload.library.php',
                'package'  => PHPFOX_CACHE_DIR . '_parameters.library.php',
            ];

            $rebuild = PHPFOX_ENV == 'development';

            if (!file_exists($libraryFiles['autoload'])
                OR !file_exists($libraryFiles['package'])
            ) {
                $rebuild = true;
            }

            if ($rebuild) {
                Phpfox::buildLibraryFiles($libraryFiles['autoload'], $libraryFiles['package']);
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
            Phpfox::addPsr4($libraryFiles['autoload']);

            // Create require services (minimum)
            self::$service = new ServiceContainer();

            /** @noinspection PhpIncludeInspection */
            // Setup parameters (minimum)
            self::$params = new ParameterContainer(include $libraryFiles['package']);

            $loader = _get('package.loader');

            /**
             * STEP 02: INIT ALL PACKAGE ENVIRONMENT
             * + Register autoload (all)
             * + Setup parameters (all)
             */

            // Register autoload (all)
            Phpfox::addPsr4($loader->getAutoloadParameters());

            // Setup parameters (all)
            Phpfox::$params->setData($loader->getPackageParameters());

            /**
             *  STEP 03: INIT SYSTEM REQUIRED SERVICES
             *
             * + Resolve conflict version of bootstrap cache & shared cache (via core.setting_version)
             * + Register error handler
             */

            // init event dispatcher
            _get('mvc.events')->initialize();

            // register error handler
            _get('error.handler')->register();

            /**
             * STEP 04. NOTIFY EVENTS
             *
             * + Emit event `onStart`
             * + Emit event `onReady`
             * + Emit event `onShutdown`
             */

            _trigger('onStart');

            _trigger('onReady');
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
                    /** @noinspection PhpIncludeInspection */
                    $array = include $path;
                    if (is_array($array)) {
                        foreach ($array as $namespace => $values) {
                            if (!$namespace) {
                                continue;
                            }
                            $autoloadData[$namespace] = $values;
                        }
                    }
                } elseif (strpos($path, $packageChecker)) {
                    /** @noinspection PhpIncludeInspection */
                    $array = include $path;
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


            /** @noinspection PhpIncludeInspection */
            $parameters['db.adapters']['default'] = include PHPFOX_DATABASE_FILE;

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

        /**
         * @param array|string $array
         */
        public static function addPsr4($array)
        {
            $autoloader = include PHPFOX_DIR . 'vendor/autoload.php';

            if (is_string($array)) {
                /** @noinspection PhpIncludeInspection */
                $array = include $array;
            }

            if ($array instanceof Parameters) {
                foreach ($array->all() as $namespace => $paths) {
                    if (!$namespace) {
                        continue;
                    }
                    if (is_string($paths)) {
                        $autoloader->addPsr4($namespace . '\\', PHPFOX_DIR . '/' . $paths);
                    } elseif (is_array($paths)) {
                        foreach ($paths as $path) {
                            $autoloader->addPsr4($namespace . '\\', PHPFOX_DIR . '/' . $path);
                        }
                    }
                }
            } elseif (is_array($array)) {
                foreach ($array as $namespace => $paths) {
                    if (!$namespace) {
                        continue;
                    }
                    if (is_string($paths)) {
                        $autoloader->addPsr4($namespace . '\\', PHPFOX_DIR . '/' . $paths);
                    } elseif (is_array($paths)) {
                        foreach ($paths as $path) {
                            $autoloader->addPsr4($namespace . '\\', PHPFOX_DIR . '/' . $path);
                        }
                    }
                }
            }
        }
    }
}