<?php

namespace Neutron\Core\Form\Admin\LogDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectLogDriver extends SelectCoreDriver
{
    protected $driverType = 'log';

    protected $cancelUrl = 'admin.core.log';
}