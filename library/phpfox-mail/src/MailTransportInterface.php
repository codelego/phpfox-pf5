<?php

namespace Phpfox\Mail;


interface MailTransportInterface
{
    public function send(MailMessage $item);
}