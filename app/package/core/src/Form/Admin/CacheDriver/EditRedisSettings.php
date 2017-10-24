<?php

namespace Neutron\Core\Form\Admin\CacheDriver;


use Phpfox\Form\Form;

class EditRedisSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Redis Settings', '_core.cache'));
        $this->setInfo(_text('Edit Redis Settings [Info]', '_core.cache'));

        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'title',
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'host',
            'value'    => '127.0.0.1',
            'label'    => _text('Redis Host', '_core.cache'),
            'info'    => _text('Redis Host [Info]', '_core.cache'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'port',
            'value'    => '6379',
            'label'    => _text('Redis Port', '_core.cache'),
            'info'    => _text('Redis Port [Info]', '_core.cache'),
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
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'auth',
            'label'    => _text('Redis Password', '_core.cache'),
            'info'    => _text('Redis Password [Info]', '_core.cache'),
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'prefix',
            'value'    => '',
            'label'    => _text('Redis Key Prefix', '_core.cache'),
            'info'    => _text('Redis Key Prefix [Info]', '_core.cache'),
            'required' => false,
        ]);

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'db_index',
            'value'    => 0,
            'label'    => _text('Redis DB', '_core.cache'),
            'info'    => _text('Redis DB [Info]', '_core.cache'),
            'required' => true,
            'options'=>[
                ['label'=>'0','value'=>'0',],
                ['label'=>'1','value'=>'1',],
                ['label'=>'2','value'=>'2',],
                ['label'=>'3','value'=>'3',],
                ['label'=>'4','value'=>'4',],
                ['label'=>'5','value'=>'5',],
                ['label'=>'6','value'=>'6',],
                ['label'=>'7','value'=>'7',],
                ['label'=>'8','value'=>'8',],
                ['label'=>'9','value'=>'9',],
                ['label'=>'10','value'=>'10',],
            ],
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
            'href'       => _url('admin.core.cache'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Redis ' . $data['host'] . ':' . $data['port'];
    }
}