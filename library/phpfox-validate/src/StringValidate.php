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
        $length = mb_strlen($value);
        $max = $this->get('max');
        $min = $this->get('min');
        $regexp = $this->get('regexp');

        if ($max !== null and $length > $max) {
            return false;
        }

        if ($min !== null and $length < $min) {
            return false;
        }

        if ($regexp !== null and !preg_match($regexp, $value)) {
            return false;
        }

        return true;
    }
}