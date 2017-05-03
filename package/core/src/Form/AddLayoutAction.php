<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class AddLayoutAction extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'action_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Action Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'parent_action_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Parent Action Id'),
            'required'   => false,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'action_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Action Name'),
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
            'factory'    => 'textarea',
            'name'       => 'description',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
            'label'      => _text('Description'),
            'required'   => true,
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
