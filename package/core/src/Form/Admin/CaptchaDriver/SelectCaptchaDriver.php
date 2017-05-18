<?php

namespace Neutron\Core\Form\Admin\CaptchaDriver;

use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectCaptchaDriver extends SelectCoreDriver
{
    protected $driverType = 'captcha';

    protected $cancelUrl = 'admin.core.captcha';
}