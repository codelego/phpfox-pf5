<?php

namespace Neutron\Report\Form;


use Phpfox\Form\Form;

class AddCategory extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'name',
                'label'      => _text('Category Name', 'report'),
                'required'   => true,
                'attributes' => [
                    'class'     => 'form-control',
                    'maxlength' => '40',
                ],
            ],
            [
                'factory' => 'choice',
                'name'    => 'is_active',
                'render'  => 'yesno',
            ],
            [
                'factory'    => 'textarea',
                'name'       => 'description',
                'required'   => true,
                'attributes' => ['class' => 'form-control', 'rows' => '5'],
            ],
        ]);
    }
}