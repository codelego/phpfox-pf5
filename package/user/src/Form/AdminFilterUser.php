<?php

namespace Neutron\User\Form;


use Phpfox\Form\Form;

class AdminFilterUser extends Form
{
    protected function initialize()
    {
        $this->setAttribute('class', 'form-inline');

        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'q',
                'placeholder' => 'Id, Name, Email',
            ],
            [
                'factory'    => 'choice',
                'name'       => 'role_id',
                'render'     => 'select',
                'required'   => false,
                'placeholder' => _text('Role', 'admin'),
                'options'    => [
                    ['value' => '1', 'label' => 'default'],
                ],
            ],
            [
                'factory'    => 'select',
                'name'       => 'verify',
                'required'   => false,
                'placeholder' => _text('Both'),
                'options'    => [
                    ['value' => 1, 'label' => 'Verified'],
                    ['value' => 0, 'label' => 'Un-Verified'],
                ],
            ],
            [
                'factory'    => 'button',
                'name'       => '_submit',
                'label'      => _text('Search'),
                'attributes' => [
                    'type'  => 'submit',
                    'class' => 'btn btn-search',
                ],
            ],
            [
                'factory'    => 'button',
                'name'       => '_reset',
                'label'      => _text('Reset'),
                'attributes' => [
                    'type'  => 'reset',
                    'class' => 'btn btn-reset',
                ],
            ],
        ]);
    }
}