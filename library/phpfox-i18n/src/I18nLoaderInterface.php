<?php

namespace Phpfox\I18n;


interface I18nLoaderInterface
{
    /**
     * Get map of currency code => symbol
     * + currency code must be in uppercase.
     *
     * @return array
     */
    public function loadCurrencies();

    /**
     * Get array of message for specific domain
     *
     * @param string $locale
     * @param string $domain
     *
     * @return array
     */
    public function loadMessage($locale, $domain);
}