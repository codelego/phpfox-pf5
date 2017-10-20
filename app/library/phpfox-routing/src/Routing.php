<?php

namespace Phpfox\Routing;


class Routing
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var Route
     */
    protected $route;

    /**
     * @var Route[]
     */
    protected $chains = [];

    /**
     * @var Routing[]
     */
    protected $children = [];

    /**
     * @var string
     */
    public static $path = '';

    /**
     * @param string $path
     */
    public static function setPath($path)
    {
        $path = trim($path, '/');
        if (empty($path)) {
            $path = '/';
        }
        self::$path = $path;
    }

    public function __construct($key, $route = null)
    {
        $this->key = $key;
        $this->route = $route;
    }

    /**
     * @param string     $host
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function match($host, &$parameters)
    {
        $path = Routing::$path;

        $result = false;

        if ($this->route) {
            $result = $this->route->match($path, $host, $parameters);
        } else {
            foreach ($this->chains as $chain) {
                if ($chain->match($path, $host, $parameters)) {
                    $result = true;
                    break;
                }
            }
        }

        if (false == $result) {
            return false;
        }

        if ($this->children) {
            foreach ($this->children as $child) {
                if ($child->match($host, $parameters)) {
                    return true;
                }
            }
        }

        return $result;
    }

    /**
     * @param string     $key
     * @param Parameters $params
     *
     * @return bool|mixed|string
     */
    public function compile($key, $params)
    {
        $result = '';
        if ($this->route) {
            $result = $this->route->compile($params);
        } else {
            foreach ($this->chains as $chain) {
                if (false !== ($result = $chain->compile($params))) {
                    break;
                }
            }
        }

        if (empty($key) || $this->key == $key) {
            return $result;
        }

        $c = $this;

        while ($pos = strpos($key, '.')) {
            $key = substr($key, $pos + 1);

            list($test) = explode('.', $key);

            if (isset($c->children[$test])) {
                $c = $c->children[$test];
                $result .= '/' . $c->compile($test, $params);
            }
        }
        return $result;
    }

    public function add(Routing $route)
    {
        $c = $this;
        $arr = explode('.', $route->key);
        $test = array_shift($arr);

        while ($arr) {
            if (isset($c->children[$test])) {
                $c = $c->children[$test];
            }
            $test = array_shift($arr);
        }
        $c->children[$test] = $route;
    }

    public function chain(Route $route)
    {
        $this->chains[] = $route;
    }
}