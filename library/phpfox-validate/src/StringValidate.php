<?php

namespace Phpfox\Validate;

class StringValidate extends Validate
{
    /**
     * @var int
     */
    protected $max;

    /**
     * @var int
     */
    protected $min;

    /**
     * @var string
     */
    protected $regexp;

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return string
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * @param string $regexp
     */
    public function setRegexp($regexp)
    {
        $this->regexp = $regexp;
    }

    public function isValid($value)
    {
        $this->setValue($value);

        $length = mb_strlen($value);

        if ($this->max !== null and $length > $this->max) {
            return false;
        }

        if ($this->min !== null and $length < $this->min) {
            return false;
        }

        if ($this->regexp !== null and !preg_match($this->regexp, $value)) {
            return false;
        }

        return true;
    }
}