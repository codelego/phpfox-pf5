<?php
namespace Phpfox\Action;


class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $host;

    /**
     * @param array $data
     *
     * @return Request
     */
    public static function factory($data)
    {
        $request = new Request();
        foreach ($data as $key => $value) {
            if (method_exists($request, $method = 'set' . ucfirst($key))) {
                $request->{$method}($value);
            } else {
                $request->set($key, $value);
            }
        }
        return $request;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->method == 'POST';
    }

    public function isGet()
    {
        return $this->method == 'GET';
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * add more params and override if exists.
     *
     * @param array $params
     *
     * @return $this
     */
    public function addParams($params)
    {
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }
        return $this;
    }
}