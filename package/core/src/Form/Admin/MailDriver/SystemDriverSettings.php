<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Phpfox\Form\Form;

class SystemDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('System Driver Settings', 'admin.core_mail'));
        $this->setInfo(_text('[System Driver Settings Info]', 'admin.core_mail'));
    }
}