<?php
namespace Phpfox\Router;

class RouteMain implements RouteGroupInterface
{
    /**
     * @var RouteInterface[]
     */
    protected $children = [];

    protected $name = '';

    public function add($key, RouteInterface $route)
    {
        $this->children[$key] = $route;
    }

    public function match($path, $host, $method, $protocol, &$parameters)
    {
        foreach ($this->children as $id => $child) {
            if ($child->match($path, $host, $method, $protocol, $parameters)) {
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
        return '#';
    }

    public function getUri($key, $params)
    {
        if (!isset($this->children[$key])) {
            throw new \InvalidArgumentException("Unexpected route '{$key}'");
        }

        return $this->children[$key]->getUri($key, $params);
    }

}