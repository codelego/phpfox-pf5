<?php

namespace Neutron\Core\Form\Admin\SessionDriver;

use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectSessionDriver extends SelectCoreDriver
{
    protected $driverType = 'session';

    protected $cancelUrl = 'admin.core.session';
}