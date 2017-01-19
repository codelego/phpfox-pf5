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

    public $data;

    /**
     * @var NavigationItem[]
     *
     */
    public $children = [];

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

    public function setParams($value)
    {
        if (is_string($value)) {
            $value = (array)json_decode($value, true);
        }
        $this->params = $value;
    }

    public function __get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
}