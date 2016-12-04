<?php

namespace Phpfox\Mailer;


interface MailTransportFactoryInterface
{
    /**
     * @param mixed $id
     *
     * @return MailTransportInterface
     */
    public function factory($id);
}