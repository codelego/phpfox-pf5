<?php
namespace Phpfox\Router;

class RouteGroup implements RouteGroupInterface
{
    /**
     * @var RouteGroupInterface[]
     */
    protected $chains = [];

    /**
     * @var RouteInterface[]
     */
    protected $children = [];

    /**
     * @var string
     */
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param RouteInterface $chain
     */
    public function chain($chain)
    {
        $this->chains[] = $chain;
    }

    public function add($key, RouteInterface $route)
    {
        $this->children[$key] = $route;
    }

    /**
     * @return RouteInterface[]
     */
    public function all()
    {
        return $this->chains;
    }

    /**
     * @param string     $path
     * @param string     $host
     * @param string     $method
     * @param string     $protocol
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function match($path, $host, $method, $protocol, &$parameters)
    {
        $matched = false;
        foreach ($this->chains as $key => $rule) {
            if ($rule->match($path, $host, $method, $protocol, $parameters)) {
                $matched = true;
                break;
            }
        }

        if (!$matched) {
            return false;
        }

        $end = trim($parameters->get('retain'), '/');
        if (!$end) {
            $end = '/';
        }

        foreach ($this->children as $id => $child) {
            if ($child->match($end, $host, $method, $protocol, $parameters)) {
                $parameters->set('info.rule', $id);
                if ($parameters->isValid()) {
                    return true;
                }
            }
        }
        return $parameters->isValid();
    }

    public function compileUri($params)
    {
        return '';
    }

    public function getUri($key, $params = [])
    {
        $result = null;
        foreach ($this->chains as $chain) {
            if (false !== ($result = $chain->getUri($key, $params))) {
                break;
            }
        }

        if (false == $result) {
            return false;
        }

        if (!isset($this->children[$key])) {
            return $result;
        }

        return $result .'/'. $this->children[$key]->getUri($key, $params);
    }
}