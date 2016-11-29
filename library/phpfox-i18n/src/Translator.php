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

    /**
     * @var LoaderInterface
     */
    protected $loader;

    /**
     * @inheritdoc
     */
    public function translate(
        $message,
        $domain = null,
        $locale = null,
        $data = null
    ) {
        $domain = $domain ?: '';
        $locale = $locale ?: $this->locale;

        $message = (isset($this->messages[$domain])
            ?: $this->messages[$domain]
                = new TextDomain($locale))->textPlural($locale, $message, 0);

        if (!$data) {
            return $message;
        }

        return _sprintf($message, $data);
    }

    /**
     * @inheritdoc
     */
    public function plural(
        $message,
        $number,
        $domain = null,
        $locale = null,
        $data = null
    ) {
        $domain = $domain ?: '';
        $locale = $locale ?: $this->locale;

        $message = (isset($this->messages[$domain])
            ?: $this->messages[$domain]
                = new TextDomain($locale))->textPlural($locale, $message,
            $number);

        if (!$data) {
            return $message;
        }

        return _sprintf($message, $data);
    }

    /**
     * @inheritdoc
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @inheritdoc
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }
}