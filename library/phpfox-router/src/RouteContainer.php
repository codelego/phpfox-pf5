<?php

namespace Phpfox\Router;

/**
 * Class RouteContainer
 *
 * @package Phpfox\Router
 */
class RouteContainer
{
    /**
     * router by name
     *
     * @var RouteInterface[]
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $phrases = [];

    /**
     * @var string
     */
    protected $fallbackId;

    /**
     * RouteManager constructor.
     */
    public function __construct()
    {
        echo "create from constructor";
        $this->reset();
    }

    /**
     * Start to build routing
     */
    public function reset()
    {
        $this->routes = [];
        $routes = config('router.routes');
        $this->phrases = config('router.phrases');

        foreach ($routes as $k => $v) {
            $this->routes[$k] = $this->build($v);
        }
    }

    /**
     * @ignore
     *
     * @param array $params
     *
     * @return RouteInterface
     */
    protected function build($params)
    {
        if (empty($params['type'])) {
            $params['type'] = StandardRoute::class;
        }

        $params['route'] = str_replace(['{', '}'], ['', ''],
            strtr($params['route'], $this->phrases));

        return new $params['type']($params);
    }

    /**
     * has router
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return isset($this->routes[$id]);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @return $this
     */
    public function add($id, $params)
    {
        $this->routes[$id] = $this->build($params);

        return $this;
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @return string
     */
    public function getUrl($id, $params = [])
    {
        return $this->get($id)->getUrl($params);
    }

    /**
     * @param  string $id
     *
     * @return RouteInterface
     * @throws RouteException
     */
    public function get($id)
    {
        if (isset($this->routes[$id])) {
            return $this->routes[$id];
        }

        // todo use production/development to control
        if (null != $this->fallbackId) {
            return $this->routes[$this->fallbackId];
        }

        throw new RouteException("Unexpected route '{$id}'");
    }

    /**
     * @param string $path
     * @param string $host
     * @param string $method
     * @param string $protocol
     *
     * @return RouteResult
     */
    public function resolve($path, $host, $method, $protocol)
    {
        $result = new RouteResult();

        foreach ($this->routes as $id => $route) {
            if (!$route->match($path, $host, $method, $protocol, $result)) {
                $result->reset();
                continue;
            }
            break;
        }

        $result->ensure();

        return $result;
    }

    /**
     * Be careful that $fallbackId exists.
     *
     * @param string $fallbackId
     */
    public function setFallback($fallbackId)
    {
        $this->fallbackId = $fallbackId;
    }

    public function __sleep()
    {
        return ['routes', 'fallbackId'];
    }

    public function __wakeup()
    {

    }
}