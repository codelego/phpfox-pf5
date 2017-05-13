<?php

namespace Neutron\Core\Form\Admin\AclSettingValue;

use Phpfox\Form\Form;

class FilterAclSettingValue extends Form
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

        // skip element `value_id` #identity

        // element `action_id`
        $this->addElement([
            'name'      => 'action_id',
            'factory'   => 'text',
            'label'     => _text('Action', null),
            'maxlength' => 255,
        ]);

        // element `role_id`
        $this->addElement([
            'name'      => 'role_id',
            'factory'   => 'text',
            'label'     => _text('Role', null),
            'maxlength' => 255,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'maxlength' => 255,
        ]);

        // element `value_actual`
        $this->addElement([
            'name'      => 'value_actual',
            'factory'   => 'text',
            'label'     => _text('Value Actual', null),
            'maxlength' => 255,
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
