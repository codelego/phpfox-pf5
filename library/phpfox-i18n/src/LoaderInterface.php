<?php

namespace Phpfox\I18n;


interface LoaderInterface
{
    /**
     * @param $locale
     * @param $domain
     *
     * @return array
     */
    public function load($locale, $domain);
}