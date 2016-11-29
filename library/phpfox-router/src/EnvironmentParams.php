<?php
namespace Phpfox\Router;

/**
 * Todo implement EnvironmentParams
 * - Use `Fail-over - Retry` pattern.
 *
 * @package Phpfox\Router
 */
class EnvironmentParams
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $key
     *
     * @return string
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key]
            : $this->fallback($key);
    }

    public function assign($params)
    {
        foreach ($params as $k => $v) {
            $this->data[$k] = $v;
        }
        return $this;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function fallback($key)
    {
        return $key;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function fill($data)
    {
        return $data;
    }
}