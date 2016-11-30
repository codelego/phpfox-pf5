<?php

namespace Phpfox\I18n;


interface TranslatorInterface
{
    /**
     * @param string $id
     * @param string $domain
     * @param string $locale
     * @param array  $data
     *
     * @return string
     */
    public function translate(
        $id,
        $domain = null,
        $locale = null,
        $data = null
    );

    /**
     * @param string $id
     * @param int    $number
     * @param string $domain
     * @param string $locale
     * @param array  $ctx
     *
     * @return string
     */
    public function plural(
        $id,
        $number,
        $domain = null,
        $locale = null,
        $ctx = null
    );

    /**
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale);

    /**
     * @return string
     */
    public function getLocale();
}