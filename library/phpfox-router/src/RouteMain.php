<?php
namespace Phpfox\Router;

class RouteMain implements RouteGroupInterface
{
    /**
     * @var RouteInterface[]
     */
    protected $children = [];

    /**
     * @var bool
     */
    protected $debug = false;

    protected $name = '';

    public function add($key, RouteInterface $route)
    {
        $this->children[$key] = $route;
    }

    public function match($path, $host, $method, $protocol, &$parameters)
    {
        foreach ($this->children as $id => $child) {
            if ($this->debug) {
                echo 'checked route "', $id, '" ~ ', '"', $path, '"', PHP_EOL;
            }
            if ($child->match($path, $host, $method, $protocol, $parameters)) {
                if ($this->debug) {
                    echo "matched route " . $id, PHP_EOL;
                }
                $parameters->set('info.rule', $id);
                if ($parameters->isValid()) {
                    return true;
                }
            }
        }
        return $parameters->isValid();
    }

    public function getUrl($key, $params = [])
    {
        if (!isset($this->children[$key])) {
            throw new \InvalidArgumentException("Unexpected route '{$key}'");
        }

        return $this->children[$key]->getUrl($params);
    }
}