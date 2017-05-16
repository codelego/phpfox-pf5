<?php

namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditLoginSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('User Registration Settings', 'user_login'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
    }
}