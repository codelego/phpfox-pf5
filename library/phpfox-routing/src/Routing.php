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

    public function __construct($key, $route = null)
    {
        $this->key = $key;
        $this->route = $route;
    }

    /**
     * @param string     $path
     * @param string     $host
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function match($path, $host, &$parameters)
    {
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

        if ($parameters->get('retain')) {
            $path = $parameters->get('retain');
        }

        if ($this->children) {
            foreach ($this->children as $child) {
                if ($child->match($path, $host, $parameters)) {
                    return true;
                }
            }
        }

        return $result;
    }

    public function getUri($key, $params)
    {
        $result = '';
        if ($this->route) {
            $result = $this->route->getUri($params);
        } else {
            foreach ($this->chains as $chain) {
                if (false !== ($result = $chain->getUri($params))) {
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
                $result .= '/' . $c->getUri($test, $params);
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