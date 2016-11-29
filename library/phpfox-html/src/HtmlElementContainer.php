<?php

namespace Phpfox\Html;

class HtmlElementContainer implements HtmlElementInterface
{
    /**
     * @var array
     */
    protected $container = [];

    /**
     * @var array
     */
    protected $map = [];


    public function __construct($key)
    {
        if(is_string($key)){
            $this->map = config($key);
            foreach ($this->map as $k => $v) {
                $this->get($k);
            }
        }
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return $v->getHtml();
        }, $this->container));
    }

    /**
     * @param string $id
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($id, $value)
    {
        $this->container[$id] = $value;

        return $this;
    }

    /**
     * @param  string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return isset($this->container[$id]) ? $this->container[$id]
            : $this->container[$id] = $this->build($id);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function build($id)
    {
        if (!isset($this->map[$id])) {
            throw new \InvalidArgumentException("There are no item '{$id}'.");
        }

        $ref = $this->map[$id];

        $factory = array_shift($ref);

        if (is_string($factory)) {
            return call_user_func_array([
                new $factory(),
                'factory',
            ], $ref);
        }

        $class = array_shift($ref);

        if (empty($ref)) {
            return new $class();
        }

        return (new \ReflectionClass($class))->newInstanceArgs($ref);
    }

    public function clear()
    {
    }
}