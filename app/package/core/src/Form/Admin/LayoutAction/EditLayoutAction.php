<?php

namespace Neutron\Core\Form\Admin\LayoutAction;

use Phpfox\Form\Form;

class EditLayoutAction extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Layout Action', 'admin.i18n'));
        $this->setInfo(_text('[Edit Layout Action Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `action_id`
        $this->addElement([
            'name'      => 'action_id',
            'factory'   => 'text',
            'label'     => _text('Action Id', null),
            'note'      => _text('[Action Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `parent_action_id`
        $this->addElement([
            'name'      => 'parent_action_id',
            'factory'   => 'text',
            'label'     => _text('Parent Action Id', null),
            'note'      => _text('[Parent Action Id Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `action_name`
        $this->addElement([
            'name'      => 'action_name',
            'factory'   => 'text',
            'label'     => _text('Action Name', null),
            'note'      => _text('[Action Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', null),
            'note'      => _text('[Package Id Note]', null),
            'options'   => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `is_admin`
        $this->addElement([
            'name'     => 'is_admin',
            'factory'  => 'yesno',
            'label'    => _text('Is Admin', null),
            'note'     => _text('[Is Admin Note]', null),
            'value'    => '1',
            'required' => true,
        ]);

        // element `description`
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'textarea',
            'label'     => _text('Description', null),
            'note'      => _text('[Description Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

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
