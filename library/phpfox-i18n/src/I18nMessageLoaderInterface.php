<?php

namespace Phpfox\I18n;


interface I18nMessageLoaderInterface
{
    /**
     * Get array of message for specific domain
     *
     * @param string $locale
     * @param string $domain
     *
     * @return array
     */
    public function load($locale, $domain);
}