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
        $parameters = _get('package.loader')->getRouteParameters();

        $this->phrases = $parameters->get('phrases');

        foreach ($parameters->get('chains') as $v) {
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

        foreach ($parameters->get('routes') as $key => $v) {
            if (strpos($key, '.')) {
                list($group) = explode('.', $key, 2);
                if (isset($this->routes[$group])) {
                    $this->routes[$group]->add(new Routing($key, $this->build($v)));
                } else {
                    exit("route group $group does not exist");
                }
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
     * @param array|string $params
     *
     * @return string
     */
    public function getUrl($key, $params = [])
    {
        if (null == $key) {
            return PHPFOX_BASE_URL . $params;
        } elseif ('#' == $key) {
            return $this->getCurrentUrl(true);
        }

        $params = new Parameters($params);

        return PHPFOX_BASE_URL . $this->getUri($key, $params) . $params->getQueries();

    }

    /**
     * @param bool $short
     *
     * @return string
     */
    public function getCurrentUrl($short = true)
    {
        if ($short and isset($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
        return '/';
    }

    /**
     * @param string     $key
     * @param Parameters $params
     *
     * @return bool|mixed|string
     */
    public function getUri($key, $params)
    {
        if (strpos($key, '.') !== false) {
            list($group) = explode('.', $key, 2);
            if (isset($this->routes[$group])) {
                return $this->routes[$group]->compile($key, $params);
            }
        } elseif (isset($this->routes[$key])) {
            return $this->routes[$key]->compile($key, $params);
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

        $parameters = new Parameters();

        if (!$method) {
            ;
        }
        if (!$protocol) {
            ;
        }

        Routing::setPath($path);

        foreach ($this->routes as $key => $group) {
            if ($group->match($host, $parameters)) {
                if ($parameters->isValid()) {
                    $parameters->set('info.chain', $key);
                    return $parameters;
                }
            }
        }

        return $parameters;
    }
}