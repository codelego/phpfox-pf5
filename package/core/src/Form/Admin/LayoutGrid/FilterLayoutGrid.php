<?php

namespace Neutron\Core\Form\Admin\LayoutGrid;

use Phpfox\Form\Form;

class FilterLayoutGrid extends Form
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


        // element `grid_id`
        $this->addElement([
            'name'      => 'grid_id',
            'factory'   => 'text',
            'label'     => _text('Grid', null),
            'maxlength' => 255,
        ]);

        // element `title`
        $this->addElement([
            'name'      => 'title',
            'factory'   => 'text',
            'label'     => _text('Title', null),
            'maxlength' => 255,
        ]);

        // element `sort_order`
        $this->addElement([
            'name'      => 'sort_order',
            'factory'   => 'text',
            'label'     => _text('Sort Order', null),
            'maxlength' => 255,
        ]);

        // element `description`
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'text',
            'label'     => _text('Description', null),
            'maxlength' => 255,
        ]);

        // element `locations`
        $this->addElement([
            'name'      => 'locations',
            'factory'   => 'text',
            'label'     => _text('Locations', null),
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
