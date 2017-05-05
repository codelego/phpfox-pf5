<?php

namespace Neutron\Contact\Form;


use Phpfox\Form\ButtonField;
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
                'note'       => _text('Must be less than {0} characters', null, null, [50]),
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 50,
                    'placeholder' => 'Department Name',
                ],
            ],
            [
                'name'       => 'email',
                'label'      => _text('Contact Email', 'contact'),
                'factory'    => 'text',
                'required'   => true,
                'note'       => _text('Must be less than {0} characters', null, null, [100]),
                'attributes' => [
                    'class'       => 'form-control',
                    'maxlength'   => 100,
                    'placeholder' => 'info@example.com',
                ],
            ],
            [
                'name'    => 'is_active',
                'label'   => _text('Active', 'contact'),
                'factory' => 'yesno',
                'value'   => 1,
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