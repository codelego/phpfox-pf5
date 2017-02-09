<?php

namespace Phpfox\Routing;


class Router
{
    /**
     * @var Routing[]
     */
    protected $routes = [];

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
    protected function initialize()
    {
        $configs = \Phpfox::get('router.provider')->loadConfigs();

        $this->phrases = $configs['phrases'];

        foreach ($configs['chains'] as $v) {

            if (!isset($v['chain'])) {
                throw new InvalidArgumentException(var_export($v, 1));
            }
            $key = $v['chain'];
            unset($v['chain']);
            if (!isset($this->routes[$key])) {
                $this->routes[$key] = new Routing($key, null);
            }
            $this->routes[$key]->chain($this->build($v));
        }

        foreach ($configs['routes'] as $key => $v) {
            if (strpos($key, '.')) {
                list($group) = explode('.', $key, 2);
                $this->routes[$group]->add(new Routing($key, $this->build($v)));
            } else {
                $this->routes[$key] = new Routing($key, $this->build($v));
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
        $params['route'] = str_replace(['{', '}'], ['', ''],
            strtr($params['route'], $this->phrases));

        return new Route($params);
    }

    /**
     * @param string       $key
     * @param array|string $context
     * @param array|string $query
     *
     * @return string
     */
    public function getUrl($key, $context = [], $query = null)
    {
        if (null == $key) {
            return PHPFOX_BASE_URL . $context;
        }

        if (empty($query)) {
            $query = '';
        } elseif (is_string($query)) {
            $query = '?' . $query;
        } elseif (is_array($query)) {
            $query = '?' . http_build_query($query);
        } else {
            $query = '';
        }

        return PHPFOX_BASE_URL . $this->getUri($key, $context) . $query;

    }

    /**
     * @param string $key
     * @param array  $params
     *
     * @return bool|mixed|string
     */
    public function getUri($key, $params)
    {
        if (strpos($key, '.') !== false) {
            list($group) = explode('.', $key, 2);
            return $this->routes[$group]->getUri($key, $params);
        } elseif (isset($this->routes[$key])) {
            return $this->routes[$key]->getUri($key, $params);
        }

        return '';
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

        $path = trim($path, '/');
        if (empty($path)) {
            $path = '/';
        }

        $parameters = new Parameters();

        if (!$method) {
            ;
        }
        if (!$protocol) {
            ;
        }

        foreach ($this->routes as $key => $group) {
            if ($group->match($path, $host, $parameters)) {
                if ($parameters->isValid()) {
                    $parameters->set('info.chain', $key);
                    return $parameters;
                }
            }
        }

        return $parameters;
    }
}