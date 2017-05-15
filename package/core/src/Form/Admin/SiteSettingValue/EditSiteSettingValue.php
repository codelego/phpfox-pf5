<?php

namespace Neutron\Core\Form\Admin\SiteSettingValue;

use Phpfox\Form\Form;

class EditSiteSettingValue extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Site Setting Value', ''));
        $this->setInfo(_text('[Edit Site Setting Value Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `value_id` #identity

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', null),
            'note'      => _text('[Package Id Note]', null),
            'value'     => 'core',
            'options'   => _get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `group_id`
        $this->addElement([
            'name'      => 'group_id',
            'factory'   => 'text',
            'label'     => _text('Group Id', null),
            'note'      => _text('[Group Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'note'      => _text('[Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `value_actual`
        $this->addElement([
            'name'      => 'value_actual',
            'factory'   => 'textarea',
            'label'     => _text('Value Actual', null),
            'note'      => _text('[Value Actual Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `ordering`
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', null),
            'note'      => _text('[Ordering Note]', null),
            'value'     => '99',
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
