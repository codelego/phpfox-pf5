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
        private static $service;

        /**
         * @var \Phpfox\Support\Configs
         */
        private static $config;

        /**
         * @var bool
         */
        private static $initialized = false;

        /**
         * @var string
         */
        private static $version = '4.5.2';

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

        public static function getUserId()
        {
            return self::$service->get('auth')->getLoginId();
        }

        public static function isLoggedIn()
        {
            return self::$service->get('auth')->isLoggedIn();
        }

        public static function membersOnly()
        {
            return self::$service->get('auth')->isUser();
        }

        /**
         * @return \Phpfox\Action\Response
         */
        public static function getResponse()
        {
            return self::$service->get('response');
        }

        /**
         * @return \Phpfox\View\PhpTemplate
         */
        public static function getTemplate()
        {
            return self::$service->get('template');
        }

        /**
         * @return \Phpfox\Db\DbAdapterInterface
         */
        public static function db()
        {
            return self::$service->get('db');
        }

        /**
         * @return \Phpfox\Routing\Router
         */
        public static function router()
        {
            return self::$service->get('router');
        }

        public static function callback($name, $target = null, $context = [])
        {
            return self::$service->get('mvc.event')
                ->callback($name, $target, $context);
        }

        /**
         * @return \Phpfox\I18n\Translator
         */
        public static function translator()
        {
            return self::$service->get('translator');
        }

        /**
         * @see GatewayInterface::findById()
         *
         * @param string $model
         * @param mixed  $id
         *
         * @return \Phpfox\Model\ModelInterface
         */
        public static function findById($model, $id)
        {
            return self::$service->get('models')->findById($model, $id);
        }

        /**
         * @return string
         */
        public static function getVersion()
        {
            return self::$version;
        }
    }
}