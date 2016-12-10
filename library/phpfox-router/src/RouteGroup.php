<?php
namespace Phpfox\Router;

class RouteGroup implements RouteGroupInterface
{
    /**
     * @var RouteGroupInterface[]
     */
    protected $chains = [];

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
    protected $debug = true;

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
        $this->chains[$id] = $chain;
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

        if (!$matched) {
            return false;
        }


        $end = trim($parameters->get('retain'), '/');
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
        return '';
    }
}