<?php

namespace Neutron\Core\Form\Admin\StorageDriver;

use Phpfox\Form\Form;

class EditSshDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('SSH Storage Settings', 'admin.core_storage'));
        $this->setInfo(_text('[SSH Storage Settings Note]', 'admin.core_storage'));

        /** start elements */
        $this->addElement([
            'name'      => 'host',
            'factory'   => 'text',
            'label'     => _text('Ssh Server Host', 'admin.core_storage'),
            'note'      => _text('[Ssh Server Note]', 'admin.core_storage'),
            'value'     => '127.0.0.1',
            'maxlength' => 100,
            'required'  => true,
        ]);


        $this->addElement([
            'name'      => 'port',
            'factory'   => 'text',
            'label'     => _text('Ssh Server Port', 'admin.core_storage'),
            'note'      => _text('[Ssh Server Port Note]', 'admin.core_storage'),
            'maxlength' => 5,
            'value'     => 22,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'timeout',
            'factory'   => 'text',
            'label'     => _text('Connection Timeout', 'admin.core_storage'),
            'note'      => _text('[Connection Timeout Note]', 'admin.core_storage'),
            'maxlength' => 5,
            'value'     => 30,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'username',
            'factory'   => 'text',
            'label'     => _text('Login Username', 'admin.core_storage'),
            'note'      => _text('[Login Username Note]', 'admin.core_storage'),
            'maxlength' => 100,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'password',
            'factory'   => 'text',
            'label'     => _text('Login Password', 'admin.core_storage'),
            'note'      => _text('[Login Password Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);


        $this->addElement([
            'name'      => 'basePath',
            'factory'   => 'text',
            'label'     => _text('Base Path', 'admin.core_storage'),
            'note'      => _text('[Base Path Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'baseUrl',
            'factory'   => 'text',
            'label'     => _text('Base Url', 'admin.core_storage'),
            'note'      => _text('[Base Url Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'baseCdnUrl',
            'factory'   => 'text',
            'label'     => _text('Base CDN Url', 'admin.core_storage'),
            'note'      => _text('[Base CDN Url Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => false,
        ]);

        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'radio',
            'inline'   => false,
            'value'    => 0,
            'label'    => _text('Is Active', 'admin.core_storage'),
            'info'     => _text('[Is Active Info]', 'admin.core_storage'),
            'options'  => _service('core.storage')->getActiveIdOptions(),
            'required' => true,
        ]);
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