<?php

namespace Neutron\Core\Form\Admin\LayoutBlock;

use Phpfox\Form\Form;

class EditLayoutBlock extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Layout Block', 'admin.i18n'));
        $this->setInfo(_text('[Edit Layout Block Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `block_id` #identity
        // skip element `parent_id` #skips

        // element `container_id`
        $this->addElement([
            'name'      => 'container_id',
            'factory'   => 'text',
            'label'     => _text('Container Id', null),
            'note'      => _text('[Container Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `location_id`
        $this->addElement([
            'name'      => 'location_id',
            'factory'   => 'text',
            'label'     => _text('Location Id', null),
            'note'      => _text('[Location Id Note]', null),
            'value'     => 'main',
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `component_id`
        $this->addElement([
            'name'      => 'component_id',
            'factory'   => 'text',
            'label'     => _text('Component Id', null),
            'note'      => _text('[Component Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `ordering`
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', null),
            'note'      => _text('[Ordering Note]', null),
            'value'     => '0',
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', null),
            'note'     => _text('[Is Active Note]', null),
            'value'    => '1',
            'required' => true,
        ]);
        // skip element `params` #skips

        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
