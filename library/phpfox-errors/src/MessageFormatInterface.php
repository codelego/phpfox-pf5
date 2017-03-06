<?php

namespace Phpfox\Error;


interface MessageFormatInterface
{
    /**
     * @param MessageContainer $messages
     *
     * @return string
     */
    public function format($messages);
}