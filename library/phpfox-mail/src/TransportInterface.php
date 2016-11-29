<?php

namespace Phpfox\Mail;


interface TransportInterface
{
    public function send($item);
}