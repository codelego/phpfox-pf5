<?php

namespace Neutron\Core\Form\Admin\AclSettingGroup;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditAclSettingGroup extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Acl Setting Group', ''));
        $this->setInfo(_text('[Edit Acl Setting Group Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `group_id`
        $this->addElement([
            'name'       => 'group_id',
            'factory'    => 'text',
            'label'      => _text('Group', null),
            'note'       => _text('[Group Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `package_id`
        $this->addElement([
            'name'       => 'package_id',
            'factory'    => 'select',
            'label'      => _text('Package', null),
            'note'       => _text('[Package Note]', null),
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `title`
        $this->addElement([
            'name'       => 'title',
            'factory'    => 'text',
            'label'      => _text('Title', null),
            'note'       => _text('[Title Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `form_name`
        $this->addElement([
            'name'       => 'form_name',
            'factory'    => 'text',
            'label'      => _text('Form Name', null),
            'note'       => _text('[Form Name Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `description`
        $this->addElement([
            'name'       => 'description',
            'factory'    => 'textarea',
            'label'      => _text('Description', null),
            'note'       => _text('[Description Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `sort_order`
        $this->addElement([
            'name'       => 'sort_order',
            'factory'    => 'text',
            'label'      => _text('Sort Order', null),
            'note'       => _text('[Sort Order Note]', null),
            'value'      => '1',
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
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
