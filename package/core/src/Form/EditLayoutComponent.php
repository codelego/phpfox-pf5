<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class EditLayoutComponent extends Form
{
    public function initialize()
    {
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
            'required'   => false,
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
            'factory'    => 'text',
            'name'       => 'package_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Package Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_active',
            'label'      => _text('Is Active'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'sort_order',
            'label'      => _text('Sort Order'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'label'      => _text('Description'),
            'required'   => false,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
        ]);
    }
}
