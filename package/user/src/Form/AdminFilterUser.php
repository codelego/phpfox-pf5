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
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Id, Name, Email',
                ],
            ],
            [
                'factory'    => 'choice',
                'name'       => 'role_id',
                'render'     => 'select',
                'required'   => false,
                'attributes' => [
                    'placeholder' => _text('Role', 'admin'),
                    'class'       => 'form-control',
                ],
                'options'    => [
                    ['value' => '1', 'label' => 'default'],
                ],
            ],
            [
                'factory'    => 'select',
                'name'       => 'verify',
                'required'   => false,
                'attributes' => [
                    'placeholder' => _text('Both'),
                    'class'       => 'form-control',
                ],
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