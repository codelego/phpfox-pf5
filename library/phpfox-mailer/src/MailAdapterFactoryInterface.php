<?php

namespace Phpfox\Mailer;


interface MailAdapterFactoryInterface
{
    /**
     * @param mixed $id
     *
     * @return AdapterInterface
     */
    public function factory($id);
}