<?php

namespace Phpfox\Routing;

interface RouteInterface
{
    /**
     * @param string     $path
     * @param string     $host
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function match($path, $host, &$parameters);

    /**
     * @param Parameters $params
     *
     * @return string
     */
    public function compile($params);
}