<?php
namespace Phpfox\Router;

interface RouteInterface
{
    /**
     * @param string $uri
     * @param string $host
     * @param string $method
     * @param string $protocol
     * @param Result $parameters
     *
     * @return bool
     */
    public function match($uri, $host, $method, $protocol, &$parameters);

    /**
     * @param array $params
     *
     * @return string
     */
    public function getUrl($params = []);
}