<?php

namespace Phpfox\Validate;


use Phpfox\Error\MessageContainer;

class ValidateGroup implements \ArrayAccess
{
    /**
     * @var Validate[]
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * ValidateGroup constructor.
     *
     * @param string $group
     * @param array  $params
     */
    public function __construct($group, $params)
    {
        $params ['name'] = (string)$group;
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param array $keyValues
     */
    public function add($keyValues)
    {
        $validator = _get('validator');
        foreach ($keyValues as $name => $params) {
            $this->rules[$name] = $validator->make($name, $params);
        }
    }

    /**
     * @param mixed            $value
     * @param MessageContainer $messages
     *
     * @return bool
     */
    public function isValid($value, $messages)
    {
        $isValid = true;
        $name = $this->get('name');
        $replacements = [
            'name'  => $name,
            'value' => (string)$value,
        ];
        foreach ($this->rules as $rule) {
            if ($rule->isValid($value)) {
                continue;
            }

            $isValid = false;
            if ($messages and $rule->get('message')) {
                $messages->add($this->get('name'),
                    _sprintf($rule->get('message'), $replacements));
            }

            if ($rule->get('skip')) {
                break;
            }
        }
        return $isValid;
    }

    public function offsetExists($offset)
    {
        return isset($this->rules[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->rules[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->rules[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->rules[$offset]);
    }
}