<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'container_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Container Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'location_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Location Id'),
            'required'   => true,
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
            'name'       => 'sort_order',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Sort Order'),
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
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}
