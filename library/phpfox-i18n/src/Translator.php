<?php
namespace Phpfox\I18n;


class Translator
{
    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * @var MessageDomain[]
     */
    protected $messages = [];

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
        $domain = $domain ? $domain : '';
        $locale = $locale ? $locale : $this->locale;
        $key = $locale . '_n_' . $domain;

        if (!isset($this->messages[$key])) {
            $this->messages[$key] = new MessageDomain($locale, $domain);
        }

        $id = $this->messages[$key]->trans($id);

        if (!$context) {
            return $id;
        }

        return _sprintf($id, $context);
    }

    /**
     * @param string $id
     * @param string $number
     * @param string $domain
     * @param string $locale
     * @param string $context
     *
     * @return mixed|string
     */
    public function choice($id, $number, $domain, $locale, $context)
    {
        $domain = $domain ? $domain : '';
        $locale = $locale ? $locale : $this->locale;
        $key = $locale . '_n_' . $domain;

        if (!isset($this->messages[$key])) {
            $this->messages[$key] = new MessageDomain($locale, $domain);
        }

        $id = $this->messages[$key]->choice($id, $number);

        if (!$context) {
            return $id;
        }

        return _sprintf($id, $context);
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }
}