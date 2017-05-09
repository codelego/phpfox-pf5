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
            'options'    => _service('layout_loader')
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
            'options'    => _service('layout_loader')
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

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd'=>'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
