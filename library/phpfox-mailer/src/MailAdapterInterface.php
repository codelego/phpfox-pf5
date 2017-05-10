<?php

namespace Phpfox\Mailer;


interface MailAdapterInterface
{
    /**
     * @param Message $msg
     *
     * @return bool
     */
    public function send(Message $msg);

    /**
     * Release resource, It's helpful when running a long task.
     */
    public function release();
}