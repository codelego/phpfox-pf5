<?php

namespace Neutron\Core\Form\Admin\CacheDriver;

use Phpfox\Form\Form;

class FilterCacheDriver extends Form
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


        // element `driver_id`
        $this->addElement([
            'name'      => 'driver_id',
            'factory'   => 'text',
            'label'     => _text('Driver', null),
            'maxlength' => 255,
        ]);

        // element `driver_name`
        $this->addElement([
            'name'      => 'driver_name',
            'factory'   => 'text',
            'label'     => _text('Driver Name', null),
            'maxlength' => 255,
        ]);

        // element `form_name`
        $this->addElement([
            'name'      => 'form_name',
            'factory'   => 'text',
            'label'     => _text('Form Name', null),
            'maxlength' => 255,
        ]);

        // element `description`
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'text',
            'label'     => _text('Description', null),
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
