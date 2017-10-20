<?php

namespace Phpfox\I18n;

class I18nLocale
{

    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * @var CurrencyFormater
     */
    protected $currencyFormater;

    /**
     * @var NumberFormater
     */
    protected $numberFormater;

    /**
     * @var DateFormater
     */
    protected $dateFormater;

    /**
     * @var PluralRule
     */
    protected $pluralRule;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * I18nLocale constructor.
     *
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $id
     * @param string $domain
     * @param int    $choice
     *
     * @return string
     */
    public function getMessage($id, $domain, $choice = 0)
    {
        if (!isset($this->messages[$domain])) {
            $this->messages[$domain] = \Phpfox::get('i18n.loader')
                ->loadMessage($this->locale, $domain);
        }
        if (isset($this->messages[$domain][$id])) {
            if (is_array($message = $this->messages[$domain][$id])) {
                return $message[$choice];
            } else {
                return $message;
            }
        }

        if ($domain != '') {
            return $this->getMessage($id, '');
        }

        return $id;
    }

    /**
     * @param string      $id
     * @param string|null $domain
     * @param array|null  $context
     *
     * @return string
     */
    public function trans($id, $domain, $context)
    {
        if (!$context) {
            return $this->getMessage($id, $domain);
        } else {
            return _sprintf($this->getMessage($id, $domain), $context);
        }
    }

    /**
     * @param string        $id
     * @param number|string $number
     * @param string|null   $domain
     * @param array|null    $context
     *
     * @return mixed|string
     */
    public function choice($id, $domain, $number, $context)
    {
        if (!$context) {
            return $this->getMessage($id, $domain, $this->evaluate($number));
        } else {
            return _sprintf($this->getMessage($id, $domain, $this->evaluate($number)), $context);
        }
    }

    /**
     * @param mixed $number
     * @param int   $precision
     *
     * @return string
     */
    public function formatNumber($number, $precision)
    {
        if (!$this->numberFormater) {
            $pattern = $this->getMessage('number_format', '');
            $this->numberFormater = new NumberFormater($pattern);
        }
        return $this->numberFormater->format($number, $precision);
    }

    /**
     * @param number $number
     *
     * @return int
     */
    public function evaluate($number)
    {
        if (!$this->pluralRule) {
            $this->pluralRule = new PluralRule();
        }
        return $this->pluralRule->evaluate($number);
    }

    /**
     * @param mixed  $number
     * @param string $code
     * @param int    $precision
     * @param string $symbol
     *
     * @return string
     */
    public function formatCurrency($number, $code, $precision, $symbol)
    {
        if (!$this->currencyFormater) {
            $pattern = $this->getMessage('currency_format', '');
            $this->currencyFormater = new CurrencyFormater($pattern);
        }
        return $this->currencyFormater->format($number, $code, $precision, $symbol);
    }

    /**
     * @param mixed  $time
     * @param string $type
     *
     * @return string
     */
    public function formatDate($time, $type = null)
    {
        if (!$this->dateFormater) {
            $this->dateFormater = new DateFormater($this->locale);
        }

        return $this->dateFormater->format($time, $type);
    }

    function __sleep()
    {
        return [
            'locale',
            'currencyFormater',
            'numberFormater',
            'pluralRule',
        ];
    }
}