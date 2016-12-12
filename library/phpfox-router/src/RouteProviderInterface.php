<?php

namespace Phpfox\Router;

interface RouteProviderInterface
{
    /**
     * @return array
     */
    public function load();
}