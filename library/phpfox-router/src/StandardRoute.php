<?php

namespace Phpfox\Router;

class StandardRoute implements RouteInterface
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
    protected $filter;

    /**
     * @var  array
     */
    protected $defaults = [];

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        if (!empty($params['filter'])) {
            $this->filter = $params['filter'];
        }

        if (!empty($params['route'])) {
            $this->route = str_replace(['[:', ']'], ['<', '>'],
                $params['route']);
        }

        if (!empty($params['host'])) {
            $this->host = $params['host'];
        }

        if (!empty($params['defaults'])) {
            $this->defaults = $params['defaults'];
        }

        if ($this->route) {
            $this->routeExpression = $this->compile($this->route,
                isset($params['wheres']) ? $params['wheres'] : []);
        }

        if ($this->host) {
            $this->hostExpression = $this->compile($this->host,
                isset($params['wheres']) ? $params['wheres'] : []);
        }
    }

    /**
     * Compile uri
     *
     * @param string $uri
     * @param array  $regex
     *
     * @return string
     */
    public function compile($uri, $regex = [])
    {
        $return = preg_replace('#[.\\+*?[^\\]${}=!|]#', '\\\\$0', $uri);

        if (strpos($return, '(') !== false) {
            $return = str_replace(['(', ')',], ['(?:', ')?',], $return);
        }

        // Insert default regex for keys
        $return = str_replace(['<', '>',], ['(?P<', '>[^/]++)',], $return);

        if ($regex) {
            $search = $replace = [];
            foreach ($regex as $key => $value) {
                $search[] = "<$key>" . '[^/]++';
                $replace[] = "<$key>$value";
            }
            $return = str_replace($search, $replace, $return);
        }

        return '#^' . $return . '$#u';
    }

    /**
     * @param string $routeExpression
     */
    public function setRouteExpression($routeExpression)
    {
        $this->routeExpression = $routeExpression;
    }

    /**
     * @param mixed $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * @param array $defaults
     */
    function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }

    public function match($uri, $host, $method, $protocol, &$result)
    {
        $params = [];

        if ($host && $this->host) {
            if (!preg_match($this->hostExpression, $host, $matches)) {
                return false;
            }

            foreach ($matches as $key => $value) {
                if (is_int($key)) {
                    continue;
                }
                // Set the value for all matched keys
                $params[$key] = $value;
            }
        }

        if ($uri && $this->route) {
            if (!preg_match($this->routeExpression, $uri, $matches)) {
                return false;
            }

            foreach ($matches as $key => $value) {
                if (is_int($key)) {
                    continue;
                }

                // Set the value for all matched keys
                $params[$key] = $value;
            }
        }

        foreach ($this->defaults as $key => $value) {
            if (!isset($params[$key]) OR $params[$key] === '') {
                // Set default values for any key that was not matched
                $params[$key] = $value;
            }
        }

        $result->setParams($params);

        if (null != $this->filter) {
            if (is_string($this->filter)) {
                if (!\Phpfox::get('router.filters')->get($this->filter)
                    ->filter($result)
                ) {
                    return false;
                }
            } elseif (is_array($this->filter)) {
                foreach ($this->filter as $v) {
                    if (!\Phpfox::get('router.filters')->get($v)
                        ->filter($result)
                    ) {
                        return false;
                    }
                }
            }

        }
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
                throw new RouteException("Unexpected params {$missing}");
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
}