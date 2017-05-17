<?php

namespace {

    use Phpfox\Support\ParameterContainer;
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
            self::$service = new ServiceContainer();
            self::$params = new ParameterContainer();
        }

        /**
         * @return \Phpfox\Support\ParameterContainer
         */
        public static function configs()
        {
            return self::$params;
        }


        public static function bootstrap()
        {
            _get('error.handler')->register();

            _get('mvc.events')->initialize();
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
         *
         * @return bool
         */
        public static function addPsr4($array)
        {
            $autoloader = include PHPFOX_DIR . 'vendor/autoload.php';

            if (is_string($array)) {
                /** @noinspection PhpIncludeInspection */
                $array = include $array;
            }

            if (!is_array($array)) {
                return false;
            }

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
            return true;
        }
    }


}