<?php

namespace Neutron\Report\Form;


use Phpfox\Form\ButtonField;
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
                    'placeholder' => 'required',
                    'class'       => 'form-control',
                    'maxlength'   => '40',
                ],
            ],
            [
                'label'   => _text('Active'),
                'factory' => 'choice',
                'name'    => 'is_active',
                'render'  => 'yesno',
            ],
            [
                'label'      => _text('Description'),
                'factory'    => 'textarea',
                'name'       => 'description',
                'required'   => true,
                'attributes' => ['class' => 'form-control', 'rows' => '5'],
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'submit',
                'label'      => _text('Cancel'),
                'href'       => _url('admin.report.category'),
                'attributes' => ['class' => 'btn btn-link'],
            ]),
        ];
    }
}