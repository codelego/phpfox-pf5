<?php

namespace Phpfox\Router;

/**
 * Class RouteManagerFactory
 *
 * @package Phpfox\Router
 */
class RouteManagerFactory
{
    /**
     * @return RouteManager
     */
    public function factory()
    {
        return new RouteManager();
    }

    public function shouldCache()
    {
        return false;
    }
}