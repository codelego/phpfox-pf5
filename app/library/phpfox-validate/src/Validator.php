<?php

namespace Phpfox\Validate;

use Phpfox\Error\MessageContainer;

class Validator implements \ArrayAccess
{
    /**
     * @var ValidateGroup[]
     */
    protected $groups = [];

    /**
     * Validator constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        if ($config) {
            $this->configure($config);
        }
        $this->initialize();
    }

    /**
     * @param array $config
     */
    public function configure($config)
    {
        foreach ($config as $group => $typeParams) {
            if ($typeParams == 'label') {
                continue;
            }
            $this->add($group, $typeParams);
        }
    }

    /**
     * Overwrite this method to add rules
     */
    protected function initialize()
    {

    }

    /**
     * Add new validate rule
     *
     * @param string $group      Check on data key
     * @param array  $nameParams Validate rule type
     */
    public function add($group, $nameParams)
    {
        if (!isset($this->groups[$group])) {
            $this->groups[$group] = new ValidateGroup($group, []);
        }

        $this->groups[$group]->add($nameParams);
    }

    /**
     * @param array            $group
     * @param MessageContainer $messages
     *
     * @return bool
     */
    public function isValid($group, $messages = null)
    {
        $isValid = true;

        foreach ($this->groups as $name => $element) {
            $value = isset($group[$name]) ? $group[$name] : null;
            if (false == $element->isValid($value, $messages)) {
                $isValid = false;
            }
        }
        return $isValid;
    }

    /**
     * @param string $group
     * @param string $name
     *
     * @return bool
     */
    public function has($group, $name)
    {
        if (!isset($this->groups[$group])) {
            return false;
        }
        if (!isset($this->groups[$group][$name])) {
            return false;
        }
        return true;
    }

    /**
     * @param string $group
     * @param string $name
     *
     * @return ValidateInterface|null
     */
    public function get($group, $name)
    {
        if (!isset($this->groups[$group])) {
            return null;
        }
        if (!isset($this->groups[$group][$name])) {
            return null;
        }
        return $this->groups[$group][$name];
    }

    /**
     * This method is helpful to inject params to any rule.
     * <code>
     * $this->setParam('name','callback','id',12);
     * </code>
     *
     * @param string $group Data key
     * @param string $name  Rule type
     * @param string $key   Parameter name
     * @param string $value Parameter value
     */
    public function setParam($group, $name, $key, $value)
    {
        $field = $this->get($group, $name);
        if (!$field) {
            return;
        }
        $field->set($key, $value);
    }

    public function offsetExists($offset)
    {
        return isset($this->groups[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->groups[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->groups[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->groups);
    }
}