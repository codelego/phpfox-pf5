<?php

namespace Phpfox\Router;

interface RouteLoaderInterface
{
    /**
     * @return array
     */
    public function load();
}