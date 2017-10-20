<?php

namespace Phpfox\Kernel;

class Event
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var mixed
     */
    protected $target;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var bool
     */
    protected $stopped = false;

    /**
     * Event constructor.
     *
     * @param string $name
     * @param mixed  $target
     * @param array  $params
     */
    public function __construct($name, $target, $params)
    {
        $this->name = $name;

        if (null != $target) {
            $this->target = $target;
        }
        if (null != $params) {
            $this->params = $params;
        }
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function getParams()
    {
        return $this->params;
    }


    public function getParam($name)
    {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    public function isStopped()
    {
        return $this->stopped;
    }

    public function stop($flag)
    {
        return $this->stopped = (bool)$flag;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getName()
    {
        return $this->name;
    }
}