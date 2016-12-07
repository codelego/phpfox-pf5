<?php
namespace Neutron\User\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;
use Phpfox\Form\Text;

class AccountSettings extends Form
{
    protected function initialize()
    {
        $this->addElement(new Text([
            'name'       => 'username',
            'label'      => 'Username',
            'required'   => true,
            'attributes' => [
                'placeholder' => 'username',
                'class'       => 'form-control username',
            ],
        ]));

        $this->addElement(new Text([
            'name'       => 'password',
            'label'      => 'Password',
            'required'   => true,
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'password',
                'class'       => 'form-control password',
            ],
        ]));

        $this->addElement(new Button([
            'name'       => '_submit',
            'label'      => 'Login',
            'required'   => true,
            'attributes' => [
                'class' => 'btn btn-primary',
            ],
        ]));
    }
}