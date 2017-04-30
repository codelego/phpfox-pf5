<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'block_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Block Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'block_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Block Name'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'block_class',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Block Class'),
            'required'   => false,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'form_class',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Form Class'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'package_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Package Id'),
            'required'   => true,
            'options'    => \Phpfox::get('core.packages')
                ->getPackageIdOptions(),
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
}
