<?php

namespace Phpfox\I18n;

/**
 * Class TextDomain
 *
 * @package Phpfox\I18n
 */
class TextDomain implements TextDomainInterface
{
    /**
     * @var PluralRule
     */
    protected $pluralRule;

    /**
     * @var string
     */
    protected $messages = [];

    /**
     * @inheritdoc
     */
    public function textPlural($domain, $message, $number = 0)
    {

    }

    public function text($domain, $message)
    {

    }
}