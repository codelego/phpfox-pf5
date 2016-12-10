<?php

namespace Phpfox\Router;

interface RouteGroupInterface extends RouteInterface
{

    /**
     * Add a route to group
     *
     * @param string         $key
     * @param RouteInterface $route
     */
    public function add($key, RouteInterface $route);
}