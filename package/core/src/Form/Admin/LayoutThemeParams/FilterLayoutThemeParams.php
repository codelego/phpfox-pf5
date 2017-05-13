<?php

namespace Neutron\Core\Form\Admin\LayoutThemeParams;

use Phpfox\Form\Form;

class FilterLayoutThemeParams extends Form
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

        // skip element `params_id` #identity

        // element `theme_id`
        $this->addElement([
            'name'      => 'theme_id',
            'factory'   => 'text',
            'label'     => _text('Theme', null),
            'maxlength' => 255,
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
