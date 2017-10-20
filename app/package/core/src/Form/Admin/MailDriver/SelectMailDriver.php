<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectMailDriver extends SelectCoreDriver
{
    protected $driverType = 'mail';

    protected $cancelUrl = 'admin.core.mail';
}