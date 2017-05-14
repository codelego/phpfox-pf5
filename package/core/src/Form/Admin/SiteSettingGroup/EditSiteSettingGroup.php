<?php

namespace Neutron\Core\Form\Admin\SiteSettingGroup;

use Phpfox\Form\Form;

class EditSiteSettingGroup extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Site Setting Group', ''));
        $this->setInfo(_text('[Edit Site Setting Group Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `group_id`
        $this->addElement([
            'name'      => 'group_id',
            'factory'   => 'text',
            'label'     => _text('Group Id', null),
            'note'      => _text('[Group Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', null),
            'note'      => _text('[Package Id Note]', null),
            'options'   => _get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `title`
        $this->addElement([
            'name'      => 'title',
            'factory'   => 'text',
            'label'     => _text('Title', null),
            'note'      => _text('[Title Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `form_name`
        $this->addElement([
            'name'      => 'form_name',
            'factory'   => 'text',
            'label'     => _text('Form Name', null),
            'note'      => _text('[Form Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `description`
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'textarea',
            'label'     => _text('Description', null),
            'note'      => _text('[Description Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `sort_order`
        $this->addElement([
            'name'      => 'sort_order',
            'factory'   => 'text',
            'label'     => _text('Sort Order', null),
            'note'      => _text('[Sort Order Note]', null),
            'value'     => '1',
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
