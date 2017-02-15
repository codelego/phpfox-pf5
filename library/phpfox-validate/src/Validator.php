<?php

namespace Phpfox\Validate;

class Validator
{
    /**
     * @var ValidateInterface[][]
     */
    protected $elements = [];

    /**
     * @var array
     */
    protected $errors = [];

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
        foreach ($config as $key => $typeParams) {
            $this->add($key, $typeParams);
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
     * @param string $key        Check on data key
     * @param array  $typeParams Validate rule type
     */
    public function add($key, $typeParams)
    {
        foreach ($typeParams as $type => $params) {
            $this->elements[$key][$type] = \Phpfox::get('validator')
                ->make($type, $params);
        }
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function isValid($data)
    {
        $isValid = true;

        // reset errors
        $this->errors = [];

        foreach ($this->elements as $name => $elements) {
            $value = isset($data[$name]) ? $data[$name] : null;
            foreach ($elements as $element) {
                if (false == $element->isValid($value)) {
                    $this->addError($name, $element->getMessage());
                    $isValid = false;

                    if ($element->isSkipAll()) {
                        return false;
                    }
                    if ($element->isSkip()) {
                        break;
                    }
                }
            }
        }
        return $isValid;
    }

    /**
     * @param string $key
     * @param string $message
     */
    public function addError($key, $message)
    {
        $this->errors[$key][] = $message;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function getErrors($key = null)
    {
        if ($key == null) {
            return $this->errors;
        }
        return isset($this->errors[$key]) ? $this->errors[$key] : [];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasErrors($key = null)
    {
        if (null == $key) {
            return !empty($this->errors);
        }
        return !empty($this->errors[$key]);
    }

    /**
     * @param string $key
     * @param string $type
     *
     * @return bool
     */
    public function has($key, $type)
    {
        if (!isset($this->elements[$key])) {
            return false;
        }
        if (!isset($this->elements[$key][$type])) {
            return false;
        }

        return true;
    }

    /**
     * @param string $key
     * @param string $type
     *
     * @return ValidateInterface|null
     */
    public function get($key, $type)
    {
        if (!isset($this->elements[$key])) {
            return null;
        }
        if (!isset($this->elements[$key][$type])) {
            return null;
        }

        return $this->elements[$key][$type];
    }
}