<?php

namespace Neutron\Core\Form\Admin\LayoutAction;

use Phpfox\Form\Form;

class FilterLayoutAction extends Form
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


        // element `action_id`
        $this->addElement([
            'name'      => 'action_id',
            'factory'   => 'text',
            'label'     => _text('Action', null),
            'maxlength' => 255,
        ]);

        // element `parent_action_id`
        $this->addElement([
            'name'      => 'parent_action_id',
            'factory'   => 'text',
            'label'     => _text('Parent Action', null),
            'maxlength' => 255,
        ]);

        // element `action_name`
        $this->addElement([
            'name'      => 'action_name',
            'factory'   => 'text',
            'label'     => _text('Action Name', null),
            'maxlength' => 255,
        ]);

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package', null),
            'options'   => _service('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
        ]);

        // element `is_admin`
        $this->addElement([
            'name'    => 'is_admin',
            'factory' => 'select',
            'label'   => _text('Is Admin', null),
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

        // element `description`
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'text',
            'label'     => _text('Description', null),
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
