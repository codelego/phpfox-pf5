<?php
namespace Phpfox\Mvc;


class Requester
{

    /**
     * @var bool
     */
    protected $http = true;

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $protocol = 'http://';

    /**
     * @var array
     */
    protected $params = [];

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
     * @return boolean
     */
    public function isHttp()
    {
        return $this->http;
    }

    /**
     * @param boolean $http
     */
    public function setHttp($http)
    {
        $this->http = $http;
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
        $this->method = $method;
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
    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }
}