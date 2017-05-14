<?php

namespace Neutron\Core\Form\Admin\SessionDriver;


use Phpfox\Form\Form;

class EditDatabaseSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Database Settings', 'admin.core_session'));
        $this->setInfo(_text('[Database Info]', 'core_session'));


        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
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