<?php

namespace Phpfox\Validate;

class Validate implements ValidateInterface
{
    /**
     * @var bool
     */
    protected $skip = false;

    /**
     * @var bool
     */
    protected $skipAll = false;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function isValid($value)
    {
        return true;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isSkip()
    {
        return $this->skip;
    }

    public function setSkip($flag)
    {
        $this->skip = (boolean)$flag;
    }

    public function isSkipAll()
    {
        return $this->skipAll;
    }

    public function setSkipAll($flag)
    {
        $this->skipAll = (bool)$flag;
    }

    public function getError()
    {
        return $this->message;
    }

    public function initialize($params)
    {
        foreach ($params as $key => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($key))) {
                $this->{$method}($value);
            }
        }
    }

    public function __construct($params = [])
    {
        if ($params) {
            $this->initialize($params);
        }
    }
}