<?php

namespace Neutron\Core\Form\Admin\AclSettingAction;

use Phpfox\Form\Form;

class FilterAclSettingAction extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label'      => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);

        /** start elements **/

        // skip element `action_id` #identity

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package', null),
            'options'   => _get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
        ]);

        // element `group_id`
        $this->addElement([
            'name'      => 'group_id',
            'factory'   => 'text',
            'label'     => _text('Group', null),
            'maxlength' => 255,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'maxlength' => 255,
        ]);

        // element `ordering`
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', null),
            'maxlength' => 255,
        ]);

        // element `is_active`
        $this->addElement([
            'name'    => 'is_active',
            'factory' => 'select',
            'label'   => _text('Is Active', null),
            'options' =>
                [
                    0 =>
                        [
                            'value' => 1,
                            'label' => 'Yes',
                        ],
                    1 =>
                        [
                            'value' => 0,
                            'label' => 'No',
                        ],
                ],
        ]);

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** end elements **/
    }
}
