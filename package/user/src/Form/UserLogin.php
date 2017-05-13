<?php

namespace Neutron\User\Form;

use Phpfox\Form\Form;

class UserLogin extends Form
{
    protected function initialize()
    {

        $this->setAttributes(['id' => 'form-login']);
        $this->setTitle(_text('Login', 'form.login'));
        $this->setInfo(_text('[Login Form Info]', 'form.login'));

        $texts = [
            'username' => _text('Username'),
            'password' => _text('Password'),
            'login'    => _text('Login'),
            'remember' => _text('Keep me logged in'),
        ];
        /** start elements */
        $this->addElement([
            'factory'     => 'text',
            'name'        => 'username',
            'label'       => $texts['username'],
            'required'    => true,
            'placeholder' => $texts['username'],
        ]);
        $this->addElement([
            'factory'     => 'password',
            'name'        => 'password',
            'label'       => $texts['password'],
            'required'    => true,
            'placeholder' => $texts['password'],
        ]);
        $this->addElement([
            'factory' => 'checkbox',
            'name'    => 'remember',
            'label'   => $texts['remember'],
        ]);
        /** end elements */

        $this->addButton([
            'name'       => 'login',
            'label'      => _text('Login'),
            'attributes' => ['class' => 'btn btn-primary btn-login', 'type' => 'submit',],
        ]);
    }
}