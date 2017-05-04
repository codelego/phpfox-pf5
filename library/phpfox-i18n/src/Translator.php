<?php

namespace Phpfox\I18n;


class Translator
{
    /**
     * @var string
     */
    public $locale = 'en';

    /**
     * @var MessageDomain[]
     */
    public $messages = [];

    /**
     * @var array
     */
    protected $plurals = [];

    /**
     * @param string      $id
     * @param string|null $domain
     * @param string|null $locale
     * @param array|null  $context
     *
     * @return string
     */
    public function trans($id, $domain, $locale, $context)
    {
        $message = $this->get($locale, $domain)->get($id);

        if (null === $message && $domain != '') {
            $message = $this->get($locale, '')->get($id);
        }

        if (null === $message) {
            $message = $id;
        }

        if (!$context) {
            return $message;
        }

        return _sprintf($message, $context);
    }

    protected function get($locale, $domain)
    {
        return isset($this->messages[$key = ($locale ? $locale
                    : $this->locale) . '/' . ($domain ? $domain : '')])
            ? $this->messages[$key]
            : $this->messages[$key] = new MessageDomain($locale,
                $domain);
    }

    /**
     * @param string        $id
     * @param number|string $number
     * @param string|null   $domain
     * @param string|null   $locale
     * @param array|null    $context
     *
     * @return mixed|string
     */
    public function choice($id, $number, $domain, $locale, $context)
    {
        $choice = $this->plural($locale)->evaluate($number);

        $message = $this->get($locale, $domain)->choice($id, $choice);

        if (null === $message and $domain != '') {
            $message = $this->get($locale, '')->choice($id, $choice);
        }

        if (null === $message) {
            $message = $id;
        }

        if (!$context) {
            return $message;
        }

        return _sprintf($message, $context);
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function plural($locale)
    {
        if ($locale) {
            ;
        }
        return new PluralRule();
    }
}