<?php

namespace Neutron\User\Form;

use Phpfox\Form\Form;

class AccountSettings extends Form
{
    protected function initialize()
    {
        $texts = [
            'username' => _text('Username'),
            'password' => _text('Password'),
            'login'    => _text('Login'),
        ];

        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'username',
                'label'      => $texts['username'],
                'required'   => true,
                'attributes' => [
                    'placeholder' => $texts['username'],
                    'class'       => 'form-control username',
                ],
            ],
            [
                'factory'    => 'text',
                'name'       => 'password',
                'label'      => $texts['password'],
                'required'   => true,
                'attributes' => [
                    'type'        => 'password',
                    'placeholder' => $texts['password'],
                    'class'       => 'form-control password',
                ],
            ],
            [
                'factory'    => 'button',
                'name'       => '_submit',
                'label'      => $texts['login'],
                'required'   => true,
                'attributes' => [
                    'class' => 'btn btn-primary',
                ],
            ],
        ]);


    }
}