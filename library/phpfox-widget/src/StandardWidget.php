<?php
namespace Phpfox\Widget;

class StandardWidget implements WidgetInterface
{
    /**
     * @var array
     */
    protected $params = [];

    public function __construct($params = [])
    {
        if ($params) {
            $this->params = $params;
        }
    }

    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params = [])
    {
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }
    }

    public function run()
    {
        return false;
    }
}