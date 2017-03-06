<?php

namespace Phpfox\Error;


class MessageFormater
{
    protected $classes
        = [
            'ul'    => FormatAsList::class,
            'alert' => FormatAsAlert::class,
        ];

    /**
     * @param MessageContainer $messages
     * @param string           $type
     *
     * @return string
     */
    public function format($messages, $type = null)
    {
        return $this->make($type)->format($messages);
    }

    /**
     * @param string $type
     *
     * @return MessageFormatInterface
     */
    public function make($type)
    {
        if (null == $type) {
            $type = 'ul';
        }

        if (!isset($this->classes[$type])) {
            return new FormatAsList();
        }

        $class = $this->classes[$type];

        return new $class;
    }
}