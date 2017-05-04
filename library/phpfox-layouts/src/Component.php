<?php

namespace Phpfox\Layout;

class Component
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutBlock constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        if ($params) {
            $this->params = $params;
        }
    }

    /**
     * @param string $key
     * @param mixed  $default
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
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return false;
    }
}