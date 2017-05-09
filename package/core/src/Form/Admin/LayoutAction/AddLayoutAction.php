<?php

namespace Neutron\Core\Form\Admin\LayoutAction;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutAction extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Layout Action', 'admin.core_layout'));
        $this->setInfo(_text('[Add Layout Action Info]', 'admin.core_layout'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `action_id`
        $this->addElement([
            'name'       => 'action_id',
            'factory'    => 'text',
            'label'      => _text('Action', 'admin.core_layout'),
            'note'       => _text('[Action Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `parent_action_id`
        $this->addElement([
            'name'       => 'parent_action_id',
            'factory'    => 'text',
            'label'      => _text('Parent Action', 'admin.core_layout'),
            'note'       => _text('[Parent Action Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
        ]);

        // element `action_name`
        $this->addElement([
            'name'       => 'action_name',
            'factory'    => 'text',
            'label'      => _text('Action Name', 'admin.core_layout'),
            'note'       => _text('[Action Name Note]', 'admin.core_layout'),
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
            'label'      => _text('Package', 'admin.core_layout'),
            'note'       => _text('[Package Note]', 'admin.core_layout'),
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `is_admin`
        $this->addElement([
            'name'     => 'is_admin',
            'factory'  => 'yesno',
            'label'    => _text('Is Admin', 'admin.core_layout'),
            'note'     => _text('[Is Admin Note]', 'admin.core_layout'),
            'value'    => '1',
            'required' => true,
        ]);

        // element `description`
        $this->addElement([
            'name'       => 'description',
            'factory'    => 'textarea',
            'label'      => _text('Description', 'admin.core_layout'),
            'note'       => _text('[Description Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
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
