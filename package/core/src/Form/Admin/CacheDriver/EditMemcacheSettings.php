<?php

namespace Neutron\Core\Form\Admin\CacheDriver;


use Phpfox\Form\Form;

class EditMemcacheSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Memcache Settings', '_core.cache'));
        $this->setInfo(_text('[Memcache Settings Info]', '_core.cache'));

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'host',
            'value'    => '127.0.0.1',
            'label'    => _text('Memcache Host', '_core.cache'),
            'info'     => _text('[Memcache Host Info]', '_core.cache'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'port',
            'value'    => '6379',
            'label'    => _text('Memcache Port', '_core.cache'),
            'info'     => _text('[Memcache Port Info]', '_core.cache'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'persistent',
            'value'    => 0,
            'label'    => _text('Memcache Persistent', '_core.cache'),
            'info'     => _text('[Memcache Persistent Info]', '_core.cache'),
            'required' => true,
        ]);
        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'compression',
            'value'    => 0,
            'label'    => _text('Memcache Compression', '_core.cache'),
            'info'     => _text('[Memcache Compression Info]', '_core.cache'),
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
            'href'       => _url('admin.core.cache'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}