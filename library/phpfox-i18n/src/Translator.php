<?php
namespace Phpfox\I18n;


class Translator implements TranslatorInterface
{
    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * @var TextDomain[]
     */
    protected $messages = [];

    public function translate($id, $domain = null, $locale = null, $data = null)
    {
        $domain = $domain ? $domain : '';
        $locale = $locale ? $locale : $this->locale;
        $key = $locale . '_n_' . $domain;

        if (!isset($this->messages[$key])) {
            $this->messages[$key] = new TextDomain($locale, $domain);
        }

        $id = $this->messages[$key]->text($id);

        if (!$data) {
            return $id;
        }

        return _sprintf($id, $data);
    }

    public function plural(
        $id,
        $number,
        $domain = null,
        $locale = null,
        $ctx = null
    ) {
        $domain = $domain ? $domain : '';
        $locale = $locale ? $locale : $this->locale;
        $key = $locale . '_n_' . $domain;

        if (!isset($this->messages[$key])) {
            $this->messages[$key] = new TextDomain($locale, $domain);
        }

        $id = $this->messages[$key]->plural($id, $number);

        if (!$ctx) {
            return $id;
        }

        return _sprintf($id, $ctx);
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