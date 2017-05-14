<?php

namespace Phpfox\I18n;

class MessageDomain
{
    /**
     * @var string
     */
    private $messages = [];

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $domain;

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

        $this->messages = _get('i18n.loader')
            ->load($this->locale, $domain);
    }

    /**
     * @param string $id
     * @param int    $number
     *
     * @return mixed|null
     */
    public function choice($id, $number)
    {
        if (isset($this->messages[$id]) and is_array($this->messages[$id])) {
            if (isset($this->messages[$id][$number])) {
                return $this->messages[$id][$number];
            } else {
                return $this->messages[$id][0];
            }
        }
        return isset($this->messages[$id]) ? $this->messages[$id] : null;
    }

    /**
     * @param string $id
     *
     * @return string|null
     */
    public function get($id)
    {
        return isset($this->messages[$id]) ? $this->messages[$id] : null;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }
}