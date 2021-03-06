<?php

namespace Neutron\Core\Form\Admin\SessionDriver;


use Phpfox\Form\Form;

class EditRedisSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Redis Settings', '_core.session'));
        $this->setInfo(_text('Redis Settings [Info]', '_core.session'));

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'host',
            'value'    => '127.0.0.1',
            'label'    => _text('Redis Host', '_core.session'),
            'info'     => _text('Redis Host [Info]', '_core.session'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'port',
            'value'    => '6379',
            'label'    => _text('Redis Port', '_core.session'),
            'info'     => _text('Redis Port [Info]', '_core.session'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'hidden',
            'name'     => 'protocol',
            'value'    => 'tcp',
            'options'  => [
                ['value' => 'tcp', 'label' => 'tcp'],
            ],
            'label'    => _text('Select Redis Protocol', '_core.session'),
            'required' => true,
        ]);
        $this->addElement([
            'factory'  => 'text',
            'name'     => 'auth',
            'label'    => _text('Redis Password', '_core.session'),
            'info'     => _text('Redis Password [Info]', '_core.session'),
            'required' => false,
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'test',
            'label'      => _text('Test'),
            'attributes' => ['class' => 'btn btn-info', 'type' => 'submit',],
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
            'href'       => _url('admin.core.session'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Redis <b>' . $data['host'] . ':' . $data['port'] .'</b>';
    }
}