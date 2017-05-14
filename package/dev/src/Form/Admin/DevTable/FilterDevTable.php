<?php

namespace Neutron\Dev\Form\Admin\DevTable;

use Phpfox\Form\Form;

class FilterDevTable extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `table_name` **/
        $this->addElement([
            'name'    => 'table_name',
            'factory' => 'text',
            'label'   => _text('Table Name', null),
        ]);

        /** element `package_id` **/
        $this->addElement([
            'name'    => 'package_id',
            'factory' => 'text',
            'label'   => _text('Package', null),
            'value'   => 'core',
        ]);

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);
    }
}
