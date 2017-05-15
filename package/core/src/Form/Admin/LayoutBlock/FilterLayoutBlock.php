<?php

namespace Neutron\Core\Form\Admin\LayoutBlock;

use Phpfox\Form\Form;

class FilterLayoutBlock extends Form
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

        // skip element `block_id` #identity
        // skip element `parent_id` #skips

        // element `container_id`
        $this->addElement([
            'name'      => 'container_id',
            'factory'   => 'text',
            'label'     => _text('Container', null),
            'maxlength' => 255,
        ]);

        // element `location_id`
        $this->addElement([
            'name'      => 'location_id',
            'factory'   => 'text',
            'label'     => _text('Location', null),
            'maxlength' => 255,
        ]);

        // element `component_id`
        $this->addElement([
            'name'      => 'component_id',
            'factory'   => 'text',
            'label'     => _text('Component', null),
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
        // skip element `params` #skips

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** end elements **/
    }
}
