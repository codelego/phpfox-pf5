<?php

namespace Neutron\Contact\Form;


use Phpfox\Form\Form;

class EditContactDepartment extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'name'       => 'name',
                'label'      => _text('Department Name', 'contact'),
                'factory'    => 'text',
                'required'   => true,
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 50,
                    'placeholder' => 'Department Name',
                ],
            ],
            [
                'name'       => 'email',
                'label'      => _text('Department Email', 'contact'),
                'factory'    => 'text',
                'required'   => true,
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 50,
                    'placeholder' => 'info@example.com',
                ],
            ],
            [
                'name'     => 'is_active',
                'label'    => _text('Active', 'contact'),
                'factory'  => 'choice',
                'render'   => 'yesno',
                'required' => true,
                'value'    => 1,
            ],
        ]);
    }
}