<?php

namespace Phpfox\I18n;


interface TranslatorInterface
{
    /**
     * @param string $message
     * @param string $domain
     * @param string $locale
     * @param array  $data
     *
     * @return string
     */
    public function translate(
        $message,
        $domain = null,
        $locale = null,
        $data = null
    );

    /**
     * @param string $message
     * @param int    $number
     * @param string $domain
     * @param string $locale
     * @param array  $data
     *
     * @return string
     */
    public function plural(
        $message,
        $number,
        $domain = null,
        $locale = null,
        $data = null
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