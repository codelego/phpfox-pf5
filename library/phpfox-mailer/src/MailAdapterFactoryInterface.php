<?php

namespace Phpfox\Mailer;


interface MailAdapterFactoryInterface
{
    /**
     * @param mixed $id
     *
     * @return MailAdapterInterface
     */
    public function factory($id);
}