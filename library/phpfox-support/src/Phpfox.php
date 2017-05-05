<?php

namespace {

    use Phpfox\Support\Configs;
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
         * @var \Phpfox\Support\Configs
         */
        public static $config;

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
            self::$config = new Configs();
        }

        /**
         * @return \Phpfox\Support\Configs
         */
        public static function configs()
        {
            return self::$config;
        }


        public static function bootstrap()
        {
            Phpfox::get('error.handler')->register();

            Phpfox::get('mvc.events')->initialize();
        }

        /**
         * @see ServiceManager::get()
         *
         * @param string $id
         *
         * @return mixed
         */
        public static function get($id)
        {
            return self::$service->get($id);
        }

        /**
         * @see \Phpfox\Action\Configs::get()
         *
         * @param string $section
         * @param mixed  $item
         *
         * @return array
         */
        public static function getParam($section, $item = null)
        {
            return self::$config->get($section, $item);
        }

        /**
         * @see ServiceManager::build()
         *
         * @param string $id
         *
         * @return mixed
         */
        public static function build($id)
        {
            return self::$service->build($id);
        }

        /**
         * @see ServiceManager::has()
         *
         * @param string $id
         *
         * @return bool
         */
        public static function has($id)
        {
            return self::$service->has($id);
        }


        /**
         * @see GatewayManager::get()
         *
         * @param string $id
         *
         * @return \Phpfox\Model\GatewayInterface|\Phpfox\Db\DbTableGateway
         */
        public static function with($id)
        {
            return self::$service->get('models')->get($id);
        }

        /**
         * @see GatewayInterface::findById()
         *
         * @param string $type
         * @param mixed  $id
         *
         * @return \Phpfox\Model\ModelInterface
         */
        public static function findById($type, $id)
        {
            return self::$service->get('models')->findById($type, $id);
        }

    }
}