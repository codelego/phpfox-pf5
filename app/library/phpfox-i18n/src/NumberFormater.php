<?php

namespace Phpfox\I18n;


class NumberFormater
{
    /**
     * @var int
     */
    protected $precision = 3;

    /**
     * @var string
     */
    protected $decimalPoint = '.';

    /**
     * @var string
     */
    protected $thousandSeparator = ',';

    /**
     * NumberFormater constructor.
     *
     * @param string $pattern
     */
    public function __construct($pattern = null)
    {
        if (!$pattern or $pattern == 'number_format') {
            $pattern = '#,###.00';
        }
        $this->setPattern($pattern);
    }

    /**
     * @param number $value
     * @param int    $precision
     *
     * @return string
     */
    public function format($value, $precision)
    {
        if (null === $precision) {
            if (strpos($value, '.') !== false) {
                $precision = $this->precision;
            } else {
                $precision = 0;
            }
        }

        return number_format($value, $precision, $this->decimalPoint, $this->thousandSeparator);
    }

    /**
     * convert pattern string to formater
     * example pattern {0} #,###.00 {1}
     *
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $re = '/#([^#]*)([#]*)([^0]*)([0]*)/u';
        if (preg_match($re, $pattern, $result)) {
            $this->decimalPoint = $result[3];
            $this->precision = strlen($result[4]);
            $this->thousandSeparator = $result[1];
        }
    }
}