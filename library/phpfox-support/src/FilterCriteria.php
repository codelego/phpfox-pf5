<?php

namespace Phpfox\Support;

class FilterCriteria
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * FilterCriteria constructor.
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
    public function setCriteria($data)
    {
        $this->data[] = $data;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function addCriteria($data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        return isset($this->data[$name]) ? $this->data[$name] : $default;
    }

    /**
     * Check Criteria has key? (using array_key_exists instead of isset)
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * Return true if `isset` and FILTER_VALIDATE_INT accept.
     *
     * @param string $name
     *
     * @return bool
     */
    public function isInt($name)
    {
        return isset($this->data[$name]) and filter_var($this->data[$name], FILTER_VALIDATE_INT);
    }

    /**
     * @param string $name
     *
     * @return int
     */
    public function getInt($name)
    {
        return isset($this->data[$name]) ? intval($this->data[$name]) : 0;
    }

    /**
     * Contain array of int value
     *
     * @param string $name
     *
     * @return bool
     */
    public function isIntArray($name)
    {
        if (!isset($this->data[$name]) OR !is_array($this->data[$name])
            OR empty(is_array($this->data[$name]))
        ) {
            return false;
        }

        foreach ($this->data[$name] as $key => $value) {
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getIntArray($name)
    {
        return array_map(function ($v) {
            return intval($v);
        }, $this->data[$name]);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isString($name)
    {
        return isset($this->data[$name]) and !empty($this->data[$name]);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getString($name)
    {
        return (string)$this->data[$name];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function quoteContain($name)
    {
        return '%' . (string)$this->data[$name] . '%';
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function quoteAhead($name)
    {
        return (string)$this->data[$name] . '%';
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isArray($name)
    {
        if (!isset($this->data[$name]) OR !is_array($this->data[$name])
            OR empty(is_array($this->data[$name]))
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getArray($name)
    {
        return array_map(function ($v) {
            return (string)$v;
        }, $this->data[$name]);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isEmail($name)
    {
        return isset($this->data[$name]) and filter_has_var($this->data[$name], FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function isEmailArray($name)
    {
        if (!isset($this->data[$name]) OR !is_array($this->data[$name])
            OR empty(is_array($this->data[$name]))
        ) {
            return false;
        }

        foreach ($this->data[$name] as $key => $value) {
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getEmailArray($name)
    {
        return array_map(function ($v) {
            return (string)$v;
        }, $this->data[$name]);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getEmail($name)
    {
        return (string)$this->data[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isBoolean($name)
    {
        return isset($this->data[$name]) and filter_var($this->data[$name], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function getBoolean($name)
    {
        return boolval($this->data[$name]);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isUrl($name)
    {
        return isset($this->data[$name]) and filter_var($this->data[$name], FILTER_VALIDATE_URL);
    }

    /**
     * @param string $name
     * @param string $reg
     *
     * @return bool
     */
    public function match($name, $reg)
    {
        return isset($this->data[$name]) and preg_match($reg, $this->data[$name]);
    }
}