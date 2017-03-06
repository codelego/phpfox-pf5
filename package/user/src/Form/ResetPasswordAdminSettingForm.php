<?php

namespace Neutron\User\Form;

use Phpfox\Form\Form;

class ResetPasswordAdminSettingForm extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory' => 'radio',
                'name'    => 'user_reset_pwd__mode',
                'label'   => _text('Reset Password Flow'),
                'value'   => 'verify_email',
                'options' => [
                    [
                        'label' => 'Verify Email',
                        'value' => 'verify_email',
                        'note'  => '',
                    ],
                ],
            ],
        ]);
    }
}