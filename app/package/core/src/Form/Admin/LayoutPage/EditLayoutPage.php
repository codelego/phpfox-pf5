<?php

namespace Neutron\Core\Form\Admin\LayoutPage;

use Phpfox\Form\Form;

class EditLayoutPage extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Layout Page', ''));
        $this->setInfo(_text('[Edit Layout Page Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `page_id` #identity

        // element `action_id`
        $this->addElement([
            'name'      => 'action_id',
            'factory'   => 'text',
            'label'     => _text('Action Id', null),
            'note'      => _text('[Action Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `theme_id`
        $this->addElement([
            'name'      => 'theme_id',
            'factory'   => 'text',
            'label'     => _text('Theme Id', null),
            'note'      => _text('[Theme Id Note]', null),
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
