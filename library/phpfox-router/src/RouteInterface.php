<?php
namespace Phpfox\Router;

interface RouteInterface
{
    /**
     * @param string     $path
     * @param string     $host
     * @param string     $method
     * @param string     $protocol
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function match($path, $host, $method, $protocol, &$parameters);

    /**
     * @param string $key default is null
     * @param array  $params
     *
     * @return string|false
     */
    public function getUri($key, $params);


    /**
     * @param array $params
     *
     * @return string
     */
    public function compileUri($params);
}