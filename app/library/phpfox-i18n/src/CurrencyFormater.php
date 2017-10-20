<?php

namespace Phpfox\I18n;


class CurrencyFormater
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
     * @var string
     */
    protected $form = '{0} {3}';

    /**
     * @var array
     */
    protected $symbols = [];

    /**
     * NumberFormater constructor.
     *
     * @param string $pattern
     */
    public function __construct($pattern)
    {
        if (!$pattern or $pattern == 'number_format') {
            $pattern = '{0} #,###.00';
        }
        $this->symbols = \Phpfox::get('i18n.loader')->loadCurrencies();
        $this->setPattern($pattern);
    }

    /**
     * @param number $number
     * @param string $code
     * @param int    $precision
     * @param string $symbol
     *
     * @return string
     */
    public function format($number, $code, $precision, $symbol)
    {
        if (null === $precision) {
            if (strpos($number, '.') !== false) {
                $precision = $this->precision;
            } else {
                $precision = 0;
            }
        }

        return strtr($this->form, [
            '{0}' => $symbol ? $symbol : (isset($this->symbols[$c = strtoupper($code)]) ? $this->symbols[$c] : '$'),
            '{1}' => $code,
            '{3}' => number_format($number, $precision, $this->decimalPoint, $this->thousandSeparator),
        ]);
    }

    /**
     * convert pattern string to formater #,##0.00
     * example pattern {0} #,###.00 {1}
     * {0} mean currency symbol $, ...
     * {1} mean currency code usd, eur, etc ...
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
            $this->form = str_replace($result[0], '{3}', $pattern);
        }
    }
}