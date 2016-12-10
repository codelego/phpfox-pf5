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
     * @var RouteGroup[]
     */
    protected $groups = [];

    /**
     * @var RouteMain
     */
    protected $main;

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
        $this->initialize();
    }

    /**
     * Start to build routing
     * todo: add new route group to fast filter for a large group.
     */
    public function initialize()
    {
        $configs = \Phpfox::get('package.loader')
            ->loadRouterConfigs();

        $this->byNames = [];
        $this->phrases = $configs['phrases'];

        $this->main = new RouteMain();

        foreach ($configs['chains'] as $key => $v) {
            if (empty($v['route'])) {
                continue;
            }

            if (strpos($key, ':') == false) {
                continue;
            }

            list($name) = explode(':', $key);

            if (!isset($this->groups[$name])) {
                $this->groups[$name] = new RouteGroup($name);
            }
            $this->groups[$name]->addChain($key, $this->build($v));
        }

        foreach ($configs['routes'] as $key => $v) {
            if (strpos($key, ':') > 0) {
                list($group) = explode(':', $key);
                $this->groups[$group]->add($key, $this->build($v));
            } else {
                $this->main->add($key, $this->build($v));
            }
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
     * @return Parameters
     */
    public function run($path, $host = null, $method = null, $protocol = null)
    {
        $parameters = new Parameters();

        foreach ($this->groups as $key => $group) {
//            echo 'chain ', $id, PHP_EOL;
            if ($group->match($path, $host, $method, $protocol, $parameters)) {
                if ($parameters->isValid()) {
                    $parameters->set('info.chain', $key);
                    break;
                }
            }
        }
        return $parameters;
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

}