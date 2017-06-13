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
     * @param string $name
     * @param string $type
     *
     * @return bool
     */
    public function is($name, $type)
    {
        switch ($type) {
            case 'int':
                return isset($this->data[$name])
                    and filter_var($this->data[$name], FILTER_VALIDATE_INT);
            case 'string':
            case 'ahead':
            case 'contain':
            case 'start':
            case 'end':
                return isset($this->data[$name])
                    and !empty($this->data[$name]);
            case 'email':
                return isset($this->data[$name])
                    and filter_has_var($this->data[$name], FILTER_VALIDATE_EMAIL);
            case 'int[]':
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
            case 'string[]':
                if (!isset($this->data[$name]) OR !is_array($this->data[$name])
                    OR empty(is_array($this->data[$name]))
                ) {
                    return false;
                }
                return true;
            case 'email[]':
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
            case 'url':
                return isset($this->data[$name]) and filter_var($this->data[$name], FILTER_VALIDATE_URL);
            default:
                return false;
        }
    }

    /**
     * @param string $name
     * @param string $type
     *
     * @return mixed
     */
    public function get($name, $type)
    {
        switch ($type) {
            case 'int':
                return intval($this->data[$name]);
            case 'string':
            case 'email':
            case 'url':
                return (string)$this->data[$name];
            case 'contain':
                return '%' . (string)$this->data[$name] . '%';
            case 'start':
                return (string)$this->data[$name] . '%';
            case 'end':
                return '%' . (string)$this->data[$name];
            case 'int[]':
                return array_map(function ($v) {
                    return intval($v);
                }, $this->data[$name]);
            case 'string[]':
            case 'email[]':
            case 'url[]':
                return array_map(function ($v) {
                    return (string)$v;
                }, $this->data[$name]);
            default:
                return false;
        }
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