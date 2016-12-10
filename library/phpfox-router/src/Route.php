<?php

namespace Phpfox\Router;

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
    protected $routeExpression;

    /**
     * @var array
     */
    protected $hostExpression = [];

    /**
     * @var string
     */
    protected $protocol = 'http://';

    /**
     * @var string
     */
    protected $onMatch;

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
            'any' => '.+',
        ], isset($params['wheres']) ? $params['wheres'] : []);

        if (!empty($params['onMatch'])) {
            $this->onMatch = $params['onMatch'];
        }

        if (!empty($params['route'])) {
            $this->route = strtr(preg_replace('/\/<([\w+\_\-]+)>\?/', '(/<$1>)',
                $params['route']), ['/*' => '(/<any>)',]);
        }

        if (!empty($params['host'])) {
            $this->host = $params['host'];
        }

        if (!empty($params['defaults'])) {
            $this->defaults = $params['defaults'];
        }

        if ($this->route) {
            $this->routeExpression = $this->compile($this->route, $wheres);
        }

        if ($this->host) {
            $this->hostExpression = $this->compile($this->host, $wheres);
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

    public function match($path, $host, $method, $protocol, &$parameters)
    {
        // param by defaults value
        $params = $this->defaults;

        if ($host && $this->host) {
            if (!preg_match($this->hostExpression, $host, $matches)) {
                return false;
            }

            // Set the value for all matched keyss
            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = $value;
                }
            }
        }

        if ($path && $this->route) {
            if (!preg_match($this->routeExpression, $path, $matches)) {
                return false;
            }

            foreach ($matches as $key => $value) {
                if (!is_int($key)) {
                    $params[$key] = $value;
                }
            }
        }

        if (!$this->onMatch) {
            $parameters->add($params);
            return true;
        }

        list($service, $method) = explode('@', $this->onMatch);

        if (false == \Phpfox::get($service)->{$method}($params)) {
            return false;
        }

        $parameters->add($params);

        return true;
    }

    /**
     * Generates a URI for the current route based on the parameters given.
     *
     * @param   array $params URI parameters
     *
     * @return  string
     * @uses    Route::REGEX_GROUP
     * @uses    Route::REGEX_KEY
     */
    public function getUrl($params = [])
    {
        if (!is_array($params)) {
            $params = [];
        }

        $defaults = $this->defaults;
        $usages = [];

        /**
         * @param int   $portion
         * @param bool  $required
         * @param array $usages
         *
         * @return array
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
                throw new InvalidArgumentException("Unexpected params {$missing}");
            }

            return [$result, $usages, $required,];
        };

        list($uri, $usages) = $compile($this->route, true, $usages);

        $queryString = '';
        $query = array_diff_key($params, $usages);

        if (!empty($query)) {
            $queryString = '?' . http_build_query($query, null, '&');
        }


        // Trim all extra slashes from the URI
        $uri = preg_replace('#//+#', '/', rtrim($uri, '/'));

        if ($this->isExternal()) {
            // Need to add the host to the URI
            $host = $this->defaults['host'];

            if (strpos($host, '://') === false) {
                // Use the default defined protocol
                $host = $this->protocol . $host;
            }

            // Clean up the host and prepend it to the URI
            $uri = rtrim($host, '/') . '/' . PHPFOX_BASE_DIR . $uri
                . $queryString;
        }
        return PHPFOX_BASE_URL . $uri . $queryString;
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
            'methods'         => $this->methods,
            'host'            => $this->host,
            'route'           => $this->route,
            'hostExpression'  => $this->hostExpression,
            'routeExpression' => $this->routeExpression,
            'defaults'        => $this->defaults,
            'callback'        => $this->onMatch,
            'protocol'        => $this->protocol,
        ];
    }


}