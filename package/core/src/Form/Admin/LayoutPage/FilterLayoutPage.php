<?php

namespace Neutron\Core\Form\Admin\LayoutPage;

use Phpfox\Form\Form;

class FilterLayoutPage extends Form
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

        // skip element `page_id` #identity

        // element `action_id`
        $this->addElement([
            'name'      => 'action_id',
            'factory'   => 'text',
            'label'     => _text('Action', null),
            'maxlength' => 255,
        ]);

        // element `theme_id`
        $this->addElement([
            'name'      => 'theme_id',
            'factory'   => 'text',
            'label'     => _text('Theme', null),
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
