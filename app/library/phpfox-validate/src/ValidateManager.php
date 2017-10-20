<?php

namespace Phpfox\Validate;

class ValidateManager
{
    /**
     * @var array
     */
    protected $classes = [];

    /**
     * ValidateManager constructor.
     */
    public function __construct()
    {
        $this->classes = _param('validator_rules');
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function has($type)
    {
        return isset($this->classes[$type]);
    }

    /**
     * Add new validate interface
     *
     * @param string $type  Alias
     * @param string $class Class name
     */
    public function add($type, $class)
    {
        $this->classes[$type] = $class;
    }

    /**
     * Get instance of validate rule
     *
     * @param string $type
     * @param array  $params
     *
     * @return ValidateInterface
     */
    public function make($type, $params)
    {
        $class = isset($this->classes[$type]) ? $this->classes[$type] : null;

        if ($class == null) {
            return new NullValidate();
        }

        if (class_exists($class)) {
            return new $class($params);
        } else {
            return new NullValidate($params);
        }
    }
}