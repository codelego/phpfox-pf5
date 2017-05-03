<?php

namespace Phpfox\Routing;

class RouteUrl
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var array
     */
    protected $query = [];

    /**
     * RouteUrl constructor.
     *
     * @param string $key
     * @param array  $params
     */
    public function __construct($key, array $params = [])
    {
        $this->key = $key;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
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
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param array $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function __toString()
    {
        return '';
    }
}