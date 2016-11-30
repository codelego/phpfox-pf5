<?php

namespace Phpfox\Mvc;


class App
{
    /**
     * @var ServiceManager
     */
    protected static $service;

    protected static $initialized = false;

    public static function init()
    {
        if (self::$initialized) {
            return;
        }
        self::$initialized = true;
        self::$service = new ServiceManager();
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public static function get($id)
    {
        return self::$service->get($id);
    }

    public static function build($id)
    {
        return self::$service->build($id);
    }

    public static function has($id)
    {
        return self::$service->has($id);
    }
}