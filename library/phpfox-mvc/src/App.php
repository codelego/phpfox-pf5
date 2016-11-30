<?php

namespace Phpfox\Mvc;


use Phpfox\Html\HtmlFacades;
use Phpfox\Router\RouteManager;

class App
{
    /**
     * @var ServiceManager
     */
    protected static $_service;

    /**
     * @var ConfigContainer
     */
    protected static $_config;

    /**
     * @var bool
     */
    protected static $_initialized = false;

    /**
     * Initialize method
     */
    public static function init()
    {
        if (self::$_initialized) {
            return;
        }
        self::$_initialized = true;
        self::$_service = new ServiceManager();
        self::$_config = new ConfigContainer();
    }

    public static function getServiceContainer()
    {
        return self::$_service;
    }

    /**
     * @return ConfigContainer
     */
    public static function getConfigContainer()
    {
        return self::$_config;
    }

    public static function getEventContainer()
    {
        return self::$_service->get('events');
    }

    /**
     * @see ConfigContainer::get()
     *
     * @param string $id
     * @param string $item
     *
     * @return mixed|null
     */
    public static function getConfig($id, $item = null)
    {
        return self::$_config->get($id, $item);
    }

    public static function getParam($key)
    {
        if ($key) {
            ;
        }

        return true;
    }

    public static function getUserParam($key)
    {
        if ($key) {
            ;
        }
        return true;
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
        return self::$_service->get($id);
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
        return self::$_service->build($id);
    }

    /**
     * @see ServiceManager::has()
     *
     * @param string $id
     *
     * @return bool
     */
    public static function hasService($id)
    {
        return self::$_service->has($id);
    }


    /**
     * @see GatewayManager::get()
     *
     * @param string $id
     *
     * @return GatewayInterface
     */
    public static function gateway($id)
    {
        return self::$_service->get('gateway')->get($id);
    }

    /**
     * @see GatewayInterface::findById()
     *
     * @param string $gateway
     * @param mixed  $id
     *
     * @return ModelInterface
     */
    public function findById($gateway, $id)
    {
        return self::$_service->get('gateway')->findById($gateway, $id);
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
        return self::$_service->get('events')->emit($name, $target, $argv);
    }

    /**
     * @param EventInterface $event
     *
     * @return EventResponse|null
     */
    public static function trigger($event)
    {
        return self::$_service->get('events')->trigger($event);
    }

    public static function isUser()
    {
        return self::$_service->get('auth')->isUser();
    }

    public static function getUserId()
    {
        return self::$_service->get('auth')->getUserId();
    }

    public static function isLoggedIn()
    {
        return self::$_service->get('auth')->isLoggedIn();
    }

    public static function membersOnly()
    {
        return self::$_service->get('auth')->isUser();
    }

    /**
     * @return HtmlFacades
     */
    public static function html()
    {
        return self::$_service->get('html');
    }

    public static function trans($id, $context = [])
    {
        return self::$_service->get('translator')->translate($id, $context);
    }

    /**
     * @see RouteManager::getUrl()
     *
     * @param string $id
     * @param array  $argv
     *
     * @return string
     */
    public static function getUrl($id, $argv = [])
    {
        return self::$_service->get('routing')->getUrl($id, $argv);
    }

    /**
     * @return Responder
     */
    public static function getResponse()
    {

    }
}