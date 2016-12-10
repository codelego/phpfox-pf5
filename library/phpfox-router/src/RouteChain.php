<?php
namespace Phpfox\Router;

class RouteChain implements RouteInterface
{
    /**
     * @var RouteInterface[]
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $children = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $debug = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string         $id
     * @param RouteInterface $chain
     */
    public function addChain($id, $chain)
    {
        $this->rules[$id] = $chain;
    }

    /**
     * @param string         $id
     * @param RouteInterface $route
     */
    public function addChild($id, $route)
    {
        $this->children[$id] = $route;
    }

    /**
     * @return RouteInterface[]
     */
    public function all()
    {
        return $this->rules;
    }

    /**
     * @param string $path
     * @param string $host
     * @param string $method
     * @param string $protocol
     * @param Result $parameters
     *
     * @return bool
     */
    public function match($path, $host, $method, $protocol, &$parameters)
    {
        $matched = empty($this->rules);

        foreach ($this->rules as $key => $rule) {
            if ($this->debug) {
                echo 'checked rule "', $key, '" ~ ', '"', $path, '"', PHP_EOL;
            }
            if ($rule->match($path, $host, $method, $protocol, $parameters)) {
                $matched = true;
                if ($this->debug) {
                    echo "matched rule $key", PHP_EOL;
                }
                break;
            }
        }

        if (!$matched and !empty($this->rules)) {
            return false;
        }

        $end = trim($parameters->get('any'), '/');
        if (!$end) {
            $end = '/';
        }

        foreach ($this->children as $id => $child) {
            if ($this->debug) {
                echo 'checked route "', $id, '" ~ ', '"', $end, '"', PHP_EOL;
            }
            if ($child->match($end, $host, $method, $protocol, $parameters)) {
                if ($this->debug) {
                    echo "matched route " . $id, PHP_EOL;
                }
                $parameters->set('@rule', $id);
                if ($parameters->isValid()) {
                    return true;
                }
            }
        }
        return $parameters->isValid();
    }

    public function getUrl($params = [])
    {
        return '';
    }
}