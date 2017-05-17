<?php

namespace Phpfox\Support;

class ParameterContainer
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $data
     *
     * @return $this
     */
    public function merge($data)
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                if (!isset($this->data[$k])) {
                    $this->data[$k] = $v;
                } elseif (is_array($v)) {
                    $this->data[$k] = array_merge($this->data[$k], $v);
                } else {
                    $this->data[$k] = $v;
                }
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param string $group
     * @param string $name
     *
     * @return mixed|null
     */
    public function get($group, $name = null)
    {
        if (!isset($this->data[$group])) {
            return null;
        }

        if ($name) {
            if (!isset($this->data[$group][$name])) {
                return null;
            }
            return $this->data[$group][$name];
        }

        return $this->data[$group];
    }

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function set($key, $data)
    {
        $this->data[$key] = $data;
    }


}