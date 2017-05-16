<?php

namespace {

    use Phpfox\Support\ParameterContainer;
    use Phpfox\Support\ServiceManager;

    /**
     * @codeCoverageIgnore
     */
    class Phpfox
    {
        /**
         * @var \Phpfox\Support\ServiceManager
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

            ini_set('display_startup_errors', 1);
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            self::$initialized = true;
            self::$service = new ServiceManager();
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
    }
}