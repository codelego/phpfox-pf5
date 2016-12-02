<?php

namespace Phpfox\I18n;

class MessageDomain
{
    /**
     * @var string
     */
    protected $messages = [];

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $domain;

    /**
     * TextDomain constructor.
     *
     * @param string $locale
     * @param string $domain
     */
    public function __construct($locale, $domain)
    {
        $this->locale = $locale;
        $this->domain = $domain;

        $this->messages = \Phpfox::get('i18n.loader')
            ->load($this->locale, $domain);
    }

    /**
     * @param string $id
     * @param int    $number
     *
     * @return mixed
     */
    public function choice($id, $number = 0)
    {
        if (!isset($this->messages[$id]) || !is_array($this->messages[$id])) {
            return $id;
        }

        if (!is_array($this->messages[$id][$number])) {
            return $this->messages[$id][0];
        }

        return $this->messages[$id][$number];
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function trans($id)
    {

        if (!isset($this->messages[$id])) {
            return $id;
        }

        if (is_array($this->messages[$id])) {
            return $this->messages[$id][0];
        }

        return $this->messages[$id];
    }
}