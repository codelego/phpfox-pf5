<?php
namespace Phpfox\Router;

interface RouteInterface
{
    /**
     * @param string $path
     * @param string $host
     * @param string $method
     * @param string $protocol
     * @param Result $parameters
     *
     * @return bool
     */
    public function match($path, $host, $method, $protocol, &$parameters);

    /**
     * @param array $params
     *
     * @return string
     */
    public function getUrl($params = []);
}