<?php

namespace Phpfox\I18n;


interface TextDomainInterface
{
    /**
     * @param string $domain
     * @param string $message
     * @param int    $number
     *
     * @return string
     */
    public function textPlural($domain, $message, $number = 0);

    /**
     * @param string $domain
     * @param string $message
     *
     * @return mixed
     */
    public function text($domain, $message);
}