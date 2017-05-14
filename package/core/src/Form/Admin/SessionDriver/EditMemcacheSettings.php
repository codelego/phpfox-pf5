<?php

namespace Neutron\Core\Form\Admin\SessionDriver;


use Phpfox\Form\Form;

class EditMemcacheSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Memcache Settings', 'admin.core_session'));
        $this->setInfo(_text('[Memcache Settings Info]', 'core_session'));

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'host',
            'value'    => '127.0.0.1',
            'label'    => _text('Memcache Host', 'admin.core_session'),
            'info'     => _text('[Memcache Host Info]', 'admin.core_session'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'port',
            'value'    => '6379',
            'label'    => _text('Memcache Port', 'admin.core_session'),
            'info'     => _text('[Memcache Port Info]', 'admin.core_session'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'hidden',
            'name'     => 'protocol',
            'value'    => 'tcp',
            'options'  => [
                ['value' => 'tcp', 'label' => 'tcp'],
            ],
            'label'    => _text('Select Memcache Protocol', 'admin.core_session'),
            'info'     => _text('[Select Memcache Protocol Info]', 'admin.core_session'),
            'required' => true,
        ]);
        
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