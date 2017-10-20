<?php

namespace Phpfox\Routing;

class Parameters implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $queries = [];

    /**
     * Parameters constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->queries = $params;
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
     * @return array
     */
    public function all()
    {
        return $this->params;
    }

    /**
     * This method clear old params and set by new params.
     *
     * @param array $data
     *
     * @return $this
     */
    public function add($data)
    {
        foreach ($data as $k => $v) {
            $this->params[$k] = $v;
        }
        return $this;
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
     * Reset old data
     */
    public function reset()
    {
        $this->params = [];
    }

    public function isValid()
    {
        return !empty($this->params['action'])
            and !empty($this->params['controller']);
    }

    /**
     * @param string $key
     */
    public function used($key)
    {
        unset($this->queries[$key]);
    }

    public function offsetExists($offset)
    {
        return isset($this->params[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->params[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->params[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->params[$offset]);
    }

    public function getQueries()
    {
        if (empty($this->queries)) {
            return '';
        }

        return '?' . http_build_query($this->queries);
    }

}