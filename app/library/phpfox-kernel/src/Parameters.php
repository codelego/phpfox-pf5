<?php

namespace Phpfox\Kernel;

class Parameters
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Parameters constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function isEmpty()
    {
        return empty($this->data);
    }


    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
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
     * @param string $group
     * @param string $key
     *
     * @return mixed
     */
    public function item($group, $key)
    {
        if (!isset($this->data[$group]) or !isset($this->data[$group][$key])) {
            return null;
        }

        return $this->data[$group][$key];
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    public function add($data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function reset()
    {
        $this->data = [];
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        unset($this->data[$key]);
    }
}