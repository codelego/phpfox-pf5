<?php

namespace Phpfox\Support;

class ParameterContainer
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


    /**
     * @param array $data
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
     * Use this method to get setting from `package.php` file.
     * to get value from admin setting in `site_setting` table, try ::setting() method
     * @param string $key
     * @param string $item
     *
     * @return mixed|null
     */
    public function get($key, $item = null)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        if ($item) {
            if (!isset($this->data[$key][$item])) {
                return null;
            }
            return $this->data[$key][$item];
        }

        return $this->data[$key];
    }

    /**
     * @param string $key
     * @param mixed  $data
     */
    public function set($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function setting($key, $default)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
}