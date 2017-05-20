<?php

namespace Phpfox\I18n;


class I18n
{
    /**
     * @var string Default locale name
     */
    public $default = 'en';

    /**
     * @var I18nLocale[]
     */
    protected $locales = [];

    /**
     * @param string $locale
     *
     * @return I18nLocale
     */
    public function get($locale)
    {
        if (!$locale) {
            $locale = $this->default;
        }
        return isset($this->locales[$locale]) ? $this->locales[$locale]
            : $this->locales[$locale] = new I18nLocale($locale);
    }

    public function set($locale, I18nLocale $i18nLocale)
    {
        $this->locales[$locale] = $i18nLocale;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }
}