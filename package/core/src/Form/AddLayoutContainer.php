<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutContainer extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'grid_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'value'      => 'grid010',
            'options'    => \Phpfox::get('layout_loader')
                ->getGridIdOptions(),
            'label'      => _text('Grid Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'radio',
            'name'       => 'type_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'value'      => 'container',
            'options'    => \Phpfox::get('layout_loader')
                ->getContainerTypeIdOptions(),
            'label'      => _text('Type Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'is_active',
            'value'   => 0,
        ]);
        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'is_active',
            'value'   => 0,
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
