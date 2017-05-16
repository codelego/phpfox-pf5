<?php

namespace Neutron\Core\Form\Admin\LogDriver;


use Phpfox\Form\Form;

class EditDatabaseDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Edit Log Settings', 'admin.core_log'));
        $this->setInfo(_text('[Edit Log Settings Note]', 'admin.core_log'));

        $this->addElement(['factory' => 'hidden', 'name' => 'title']);

        /** end elements */

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}