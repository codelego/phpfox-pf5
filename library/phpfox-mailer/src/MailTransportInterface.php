<?php

namespace Phpfox\Mailer;


interface MailTransportInterface
{
    public function send(MailMessage $item);
}