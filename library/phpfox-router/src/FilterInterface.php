<?php

namespace Phpfox\Router;


interface FilterInterface
{
    public function filter(RouteResult $result);
}