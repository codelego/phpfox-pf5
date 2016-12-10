<?php

namespace Phpfox\Router;

class Router
{
    /**
     * router by name
     *
     * @var RouteInterface[]
     */
    protected $byNames = [];

    /**
     * @var RouteChain[]
     */
    protected $chains = [];

    /**
     * @var array
     */
    protected $phrases = [];

    /**
     * @var string
     */
    protected $fallbackId;

    /**
     * @var bool
     */
    protected $stopped = false;

    /**
     * RouteManager constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Start to build routing
     * todo: add new route group to fast filter for a large group.
     */
    public function reset()
    {
        $this->byNames = [];
        $this->phrases = \Phpfox::getParam('router.phrases');
        $routes = \Phpfox::getParam('routes');
        $groups = \Phpfox::getParam('router.chains');

        foreach ($groups as $k => $v) {
            if (empty($v['route'])) {
                continue;
            }
            $name = $k;
            if (strpos($k, ':') > 0) {
                list($name) = explode(':', $k);
            }
            if (!isset($this->chains[$name])) {
                $this->chains[$name] = new RouteChain($name);
            }
            $this->chains[$name]->addChain($k, $this->build($v));
        }

        // init empty chain at last
        $this->chains[''] = new RouteChain('');
        $this->chains['']->addChain('', new Route(['route'=>'(<any>)']));

        foreach ($routes as $k => $v) {
            $group = '';
            if (strpos($k, ':') > 0) {
                list($group) = explode(':', $k);
            }
            $route = $this->build($v);
            $this->chains[$group]->addChild($k, $route);
        }
    }

    /**
     * @ignore
     *
     * @param array $params
     *
     * @return RouteInterface|Route
     */
    private function build($params)
    {

        if (empty($params['type'])) {
            $params['type'] = Route::class;
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
        return isset($this->byNames[$id]);
    }

    /**
     * @param string $id
     * @param array  $params
     *
     * @return $this
     */
    public function add($id, $params)
    {
        $this->byNames[$id] = $this->build($params);

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
     * @throws InvalidArgumentException
     */
    public function get($id)
    {
        if (isset($this->byNames[$id])) {
            return $this->byNames[$id];
        }

        // todo use production/development to control
        if (null != $this->fallbackId) {
            return $this->byNames[$this->fallbackId];
        }

        throw new InvalidArgumentException("Unexpected route '{$id}'");
    }

    /**
     * @param string $path
     * @param string $host
     * @param string $method
     * @param string $protocol
     *
     * @return Result
     */
    public function run($path, $host, $method, $protocol)
    {
        $this->stopped = false;
        $parameters = new Result();

        foreach ($this->chains as $id => $route) {
//            echo 'chain ', $id, PHP_EOL;
            if ($route->match($path, $host, $method, $protocol, $parameters)) {
                if ($parameters->isValid()) {
                    $parameters->set('@chain', $id);
                    break;
                }
            }
        }
        return $parameters;
    }

    /**
     * @param bool $flag
     */
    public function stop($flag)
    {
        $this->stopped = (bool)$flag;
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