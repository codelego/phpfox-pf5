<?php

namespace Phpfox\Validate;

class Validate implements ValidateInterface
{
    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * @var array
     */
    protected $params = [];

    public function __construct($params = [])
    {
        $this->params = array_merge($this->defaults, $params);
    }

    public function isValid($value)
    {
        return true;
    }

    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    public function has($key)
    {
        return isset($this->params[$key]);
    }
}