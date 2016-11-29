<?php
namespace Phpfox\Router;

interface RouteInterface
{
    /**
     * @param string      $uri
     * @param string      $host
     * @param string      $method
     * @param string      $protocol
     * @param RouteResult $result
     *
     * @return bool
     */
    public function match($uri, $host, $method, $protocol, &$result);

    /**
     * @param array $params
     *
     * @return string
     */
    public function getUrl($params = []);
}