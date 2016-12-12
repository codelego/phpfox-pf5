<?php

namespace Phpfox\Router;

class Router
{
    /**
     * @var RouteGroup[]
     */
    protected $groups = [];

    /**
     * @var array
     */
    protected $phrases = [];

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
        $this->phrases = $configs['phrases'];

        foreach ($configs['chains'] as $key => $v) {
            if (!isset($this->groups[$key])) {
                $this->groups[$key] = new RouteGroup($key);
            }
            foreach ($v as $cfg) {
                $this->groups[$key]->chain($this->build($cfg));
            }
        }
        // append main route
        $this->groups[''] = new RouteMain();

        foreach ($configs['routes'] as $key => $v) {
            if (strpos($key, ':')) {
                list($key, $group) = explode(':', $key, 2);
            } else {
                $group = '';
            }

            if (!isset($this->groups[$group])) {
                continue;
            }
            $this->groups[$group]->add($key, $this->build($v));
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
     * @param string $id
     * @param array  $params
     *
     * @return string
     */
    public function getUrl($id, $params = [])
    {
        $group = '';
        if (strpos($id, ':') !== false) {
            list($id, $group) = explode(':', $id);
        }
        return PHPFOX_BASE_URL .$this->get($group)->getUri($id, $params);
    }

    /**
     * @param  string $id
     *
     * @return RouteInterface
     * @throws InvalidArgumentException
     */
    public function get($id)
    {
        if (isset($this->groups[$id])) {
            return $this->groups[$id];
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
                    return $parameters;
                }
            }
        }

        return $parameters;
    }
}