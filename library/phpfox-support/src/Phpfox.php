<?php

namespace {

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
            self::$service = new \Phpfox\Support\ServiceManager();
            self::$config = new \Phpfox\Support\Configs();

//        set_error_handler(function ($num, $msg, $file, $line, $context) {
//
//        });
//        set_exception_handler(function ($exception) {
//            var_dump($exception);
//        });
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
         * @param null   $item
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
        public static function getModel($id)
        {
            return self::$service->get('models')->get($id);
        }

        /**
         * @param string      $name
         * @param object|null $target
         * @param array|null  $argv
         *
         * @return mixed
         */
        public static function emit($name, $target = null, $argv = [])
        {
            return self::$service->get('mvc.events')
                ->emit($name, $target, $argv);
        }

        /**
         * @param \Phpfox\Event\Event $event
         *
         * @return \Phpfox\Event\Response|null
         */
        public static function trigger($event)
        {
            return self::$service->get('mvc.events')->trigger($event);
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
         * @return \Phpfox\Assets\AssetsFacades
         */
        public static function assets()
        {
            return self::$service->get('assets');
        }

        public static function trans($id, $domain, $locale, $context = [])
        {
            return self::$service->get('translator')
                ->translate($id, $domain, $locale, $context);
        }

        /**
         * @return \Phpfox\Action\ActionResponse
         */
        public static function getResponse()
        {
            return self::$service->get('mvc.response');
        }

        /**
         * @return \Phpfox\View\PhpTemplate
         */
        public static function getTemplate()
        {
            return self::$service->get('view.template');
        }

        /**
         * @return \Phpfox\Db\DbAdapterInterface
         */
        public static function getDb()
        {
            return self::$service->get('db');
        }

        /**
         * @return \Phpfox\Authorization\AuthorizationManager
         */
        public static function getAcl()
        {
            return self::$service->get('authorization');
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
    }
}