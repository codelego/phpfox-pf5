<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutComponent extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'is_active',
            'value'   => 1,
        ]);
        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'sort_order',
            'value'   => 1,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'component_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Component Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'component_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Component Name'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'component_class',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Component Class'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'form_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Form Name'),
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'select',
            'name'       => 'package_id',
            'attributes' =>
                [
                    'class' => 'form-control',
                ],
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'label'      => _text('Package'),
            'required'   => true,
        ]);


        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'label'      => _text('Description'),
            'required'   => false,
            'value'      => '',
            'attributes' =>
                [
                    'placeholder' => _text('Description'),
                    'maxlength'   => PHPFOX_DESC_LENGTH,
                    'class'       => 'form-control',
                    'rows'        => PHPFOX_DESC_ROWS,
                ],
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}
