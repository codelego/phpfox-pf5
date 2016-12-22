<?php

namespace Phpfox\Routing;

class Route implements RouteInterface
{
    /**
     * regular methods
     */
    protected $methods;

    /**
     * @var  string  route URI
     */
    protected $route;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var  string
     */
    protected $route_expr;

    /**
     * @var array
     */
    protected $host_expr;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var string
     */
    protected $filter;


    /**
     * @var  array
     */
    protected $defaults = [];

    /**
     * @param array $params
     * - wheres
     * - callback
     * - route
     * - host
     * - defaults
     */
    public function __construct($params)
    {
        $wheres = array_merge([
            'retain' => '.+',
        ], isset($params['wheres']) ? $params['wheres'] : []);

        if (!empty($params['filter'])) {
            $this->filter = $params['filter'];
        }

        if (!empty($params['compiler'])) {
            $this->compiler = $params['compiler'];
        }

        if (!empty($params['defaults'])) {
            $this->defaults = $params['defaults'];
        }

        if (!empty($params['route'])) {
            $this->route = strtr(preg_replace('/\/<([\w+\_\-]+)>\?/', '(/<$1>)',
                $params['route']), ['/*' => '(/<retain>)',]);
            $this->route_expr = $this->compile($this->route, $wheres);
        }

        if (!empty($params['host'])) {
            $this->host = $params['host'];
            $this->host_expr = $this->compile($this->host, $wheres);
        }
    }

    /**
     * Compile uri
     *
     * @param string $rule
     * @param array  $wheres
     *
     * @return string
     * @ignore
     */
    protected function compile($rule, $wheres = [])
    {
        $return = preg_replace('#[.\\+*?[^\\]${}=!|]#', '\\\\$0', $rule);

        if (strpos($return, '(') !== false) {
            $return = str_replace(['(', ')',], ['(?:', ')?',], $return);
        }

        // Insert default regex for keys
        $return = str_replace(['<', '>',], ['(?P<', '>[^/]++)',], $return);


        $replace = [];
        foreach ($wheres as $key => $value) {
            $replace["<$key>" . '[^/]++'] = "<$key>$value";
        }
        $return = strtr($return, $replace);

        return '#^' . $return . '$#u';
    }

    public function match($path, $host, &$parameters)
    {


        // param by defaults value
        $params = $this->defaults;

        if ($host && $this->host) {
            if (!preg_match($this->host_expr, $host, $matches)) {
                return false;
            }

            // Set the value for all matched keys
            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = $value;
                }
            }
        }

        if ($path and $this->route) {

            if (!preg_match($this->route_expr, $path, $matches)) {
                return false;
            }
            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = $value;
                }
            }
        }


        if (!$this->filter) {
            $parameters->add($params);
            return true;
        }

        if (false == \Phpfox::get($this->filter)->onMatch($params)) {
            return false;
        }

        $parameters->add($params);

        return true;
    }

    public function compileUri($params)
    {

        $defaults = $this->defaults;
        $usages = [];
        /**
         * @param int   $portion
         * @param bool  $required
         * @param array $usages
         *
         * @return string
         */
        $compile = function ($portion, $required, &$usages) use (
            &$compile,
            $defaults,
            $params
        ) {
            $missing = [];

            $pattern = '#(?:<([a-zA-Z0-9_]++)>|\(((?:(?>[^()]+)|(?R))*)\))#';

            $result = preg_replace_callback($pattern, function ($matches) use (
                &$compile,
                $defaults,
                &$missing,
                $params,
                &$required,
                &$usages
            ) {
                if ($matches[0][0] === '<') {
                    // Parameter, unwrapped
                    $param = $matches[1];

                    if (isset($params[$param])) {
                        // This portion is required when a specified
                        // parameter does not match the default
                        $required = ($required OR !isset($defaults[$param])
                            OR $params[$param] !== $defaults[$param]);

                        $usages[$param] = 1;

                        // Add specified parameter to this result
                        return $params[$param];
                    }

                    // Add default parameter to this result
                    if (isset($defaults[$param])) {
                        return $defaults[$param];
                    }

                    // This portion is missing a parameter
                    $missing[] = $param;
                } else {
                    // Group, unwrapped
                    $result = $compile($matches[2], false, $usages);

                    if ($result[1]) {
                        // This portion is required when it contains a group
                        // that is required
                        $required = true;

                        // Add required groups to this result
                        return $result[0];
                    }

                    // Do not add optional groups to this result
                }
                return null;
            }, $portion);

            if ($required AND $missing) {
                $missing = implode(',', $missing);
                throw new \InvalidArgumentException("Unexpected params {$missing}");
            }

            return [$result, $usages, $required,];
        };

        return $compile($this->route, true, $usages);
    }

    public function getUri($params)
    {
        if ($this->filter) {
            $uri = \Phpfox::get($this->filter)->onCompile($params);
            if (false === $uri) {
                return false;
            } elseif (is_string($uri)) {
                return $uri;
            }
        }

        list($uri, $usages) = $this->compileUri($params);

        $uri = preg_replace('#//+#', '/', rtrim($uri, '/'));

        return $uri;
    }

    /**
     * Returns whether this route is an external route
     * to a remote controller.
     *
     * @return  boolean
     */
    public function isExternal()
    {
        return isset($this->defaults['host']) && $this->defaults['host'];
    }

    /**
     * @return array
     * @ignore
     */
    function __debugInfo()
    {
        return [
            'methods'    => $this->methods,
            'host'       => $this->host,
            'route'      => $this->route,
            'host_expr'  => $this->host_expr,
            'route_expr' => $this->route_expr,
            'defaults'   => $this->defaults,
            'filter'     => $this->filter,
            'protocol'   => $this->protocol,
        ];
    }
}