<?php

namespace Neutron\User\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class UserLogin extends Form
{
    protected function initialize()
    {

        $this->setAttribute('id', 'form-login');
        $texts = [
            'username' => _text('Username'),
            'password' => _text('Password'),
            'login'    => _text('Login'),
            'remember' => _text('Keep me logged in'),
        ];

        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'username',
                'label'      => $texts['username'],
                'required'   => true,
                'attributes' => [
                    'placeholder' => $texts['username'],
                ],
            ],
            [
                'factory'     => 'text',
                'name'        => 'password',
                'label'       => $texts['password'],
                'required'    => true,
                'placeholder' => $texts['password'],
            ],
            [
                'factory' => 'checkbox',
                'name'    => 'remember',
                'label'   => $texts['remember'],
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'login',
                'label'      => _text('Login'),
                'attributes' => ['class' => 'btn btn-primary btn-login'],
            ]),
        ];
    }
}