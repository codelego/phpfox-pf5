<?php

namespace Neutron\Core\Form\Admin\CacheDriver;


use Phpfox\Form\Form;

class EditRedisSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Redis Settings', '_core.cache'));
        $this->setInfo(_text('[Redis Settings Info]', '_core.cache'));

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'host',
            'value'    => '127.0.0.1',
            'label'    => _text('Redis Host', '_core.cache'),
            'info'     => _text('[Redis Host Info]', '_core.cache'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'port',
            'value'    => '6379',
            'label'    => _text('Redis Port', '_core.cache'),
            'info'     => _text('[Redis Port Info]', '_core.cache'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'hidden',
            'name'     => 'protocol',
            'value'    => 'tcp',
            'options'  => [
                ['value' => 'tcp', 'label' => 'tcp'],
            ],
            'label'    => _text('Select Redis Protocol', '_core.cache'),
            'info'     => _text('[Select Redis Protocol Info]', '_core.cache'),
            'required' => true,
        ]);
        $this->addElement([
            'factory'  => 'text',
            'name'     => 'auth',
            'label'    => _text('Redis Password', '_core.cache'),
            'info'     => _text('[Redis Password]', '_core.cache'),
            'required' => false,
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
            'href'       => _url('admin.core.cache'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}