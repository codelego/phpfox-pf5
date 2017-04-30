<?php

namespace Phpfox\Navigation;

/**
 * @property string $id
 * @property string $name
 * @property string $href
 * @property string $route
 * @property string $event
 * @property array  $extra
 * @property string $class
 * @property bool   $active
 * @property string $acl
 * @property string $menu
 * @property string $section
 * @property string $label
 * @property string $parent
 * @property string $packageId
 * @property string $type
 * @property array  $params
 */
class NavigationItem
{

    /**
     * @var array
     */
    public $data = [];

    /**
     * @var NavigationItem[]
     */
    public $children = [];

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
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
     * NavigationItem constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            } else {
                $this->data[$k] = $v;
            }
        }
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
}