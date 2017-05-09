<?php

namespace Neutron\Core\Form\Admin\AclSettingValue;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddAclSettingValue extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Acl Setting Value', ''));
        $this->setInfo(_text('[Add Acl Setting Value Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `value_id` #identity

        // element `package_id`
        $this->addElement([
            'name'       => 'package_id',
            'factory'    => 'select',
            'label'      => _text('Package', null),
            'note'       => _text('[Package Note]', null),
            'value'      => 'core',
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

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

        // element `name`
        $this->addElement([
            'name'       => 'name',
            'factory'    => 'text',
            'label'      => _text('Name', null),
            'note'       => _text('[Name Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `phrase_var_name`
        $this->addElement([
            'name'       => 'phrase_var_name',
            'factory'    => 'text',
            'label'      => _text('Phrase Var Name', null),
            'note'       => _text('[Phrase Var Name Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `value_actual`
        $this->addElement([
            'name'       => 'value_actual',
            'factory'    => 'text',
            'label'      => _text('Value Actual', null),
            'note'       => _text('[Value Actual Note]', null),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
        ]);

        // element `priority`
        $this->addElement([
            'name'       => 'priority',
            'factory'    => 'text',
            'label'      => _text('Priority', null),
            'note'       => _text('[Priority Note]', null),
            'value'      => '0',
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
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
