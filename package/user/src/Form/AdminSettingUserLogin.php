<?php

namespace Neutron\User\Form;

use Neutron\Core\Form\FormSiteSettings;

class AdminSettingUserLogin extends FormSiteSettings
{
    protected function initialize()
    {
        $this->setTitle(_text('User Registration Settings', 'user_login'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));
    }
}