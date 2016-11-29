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
     * @return RouteContainer
     */
    public function factory()
    {
        return new RouteContainer();
    }

    public function shouldCache()
    {
        return false;
    }
}