<?php

namespace Phpfox\Support;

final class Configs
{
    /**
     * @var array
     */
    protected $data = [];

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


    public function set($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }
}