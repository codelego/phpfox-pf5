<?php

namespace Phpfox\Widget;

/**
 * Class StandardWidget
 *
 * @package Phpfox\Widget
 */
class StandardWidget implements WidgetInterface
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @inheritdoc
     */
    public function __construct($params = [])
    {
        if ($params) {
            $this->params = $params;
        }
    }

    /**
     * @inheritdoc
     */
    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @inheritdoc
     */
    public function setParams($params = [])
    {
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function resolve()
    {
        return false;
    }
}