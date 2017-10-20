<?php

namespace Phpfox\Kernel;

class RequestContext
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        unset($this->data[$key]);
    }
}