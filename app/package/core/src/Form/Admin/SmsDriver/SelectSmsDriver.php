<?php

namespace Neutron\Core\Form\Admin\SmsDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectSmsDriver extends SelectCoreDriver
{
    protected $driverType = 'sms';

    protected $cancelUrl = 'admin.core.sms';
}