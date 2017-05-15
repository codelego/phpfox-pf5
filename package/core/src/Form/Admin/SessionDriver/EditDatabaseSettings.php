<?php

namespace Neutron\Core\Form\Admin\SessionDriver;


use Phpfox\Form\Form;

class EditDatabaseSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Database Settings', '_core.session'));
        $this->setInfo(_text('[Database Info]', '_core.session'));


        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.core.session'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}