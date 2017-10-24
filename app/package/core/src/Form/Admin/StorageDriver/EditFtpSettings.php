<?php

namespace Neutron\Core\Form\Admin\StorageDriver;

use Phpfox\Form\Form;

class EditFtpSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('FTP/FTPs Storage Settings', '_core.storage'));
        $this->setAction(_url('#'));

        $this->addElement([
            'name'     => 'protocol',
            'factory'  => 'radio',
            'inline'   => false,
            'value'    => 0,
            'label'    => _text('Protocol', '_core.storage'),
            'info'     => _text('Protocol [Info]', '_core.storage'),
            'options'  => [
                ['value' => 'ftp', 'label' => 'FTP'],
                ['value' => 'ftps', 'label' => 'FTPs'],
            ],
            'required' => true,
        ]);

        $this->addElement([
            'name'      => 'host',
            'factory'   => 'text',
            'label'     => _text('Host Name', '_core.storage'),
            'info'      => _text('Host Name [Info]', '_core.storage'),
            'value'     => '127.0.0.1',
            'maxlength' => 100,
            'required'  => true,
        ]);


        $this->addElement([
            'name'      => 'port',
            'factory'   => 'text',
            'label'     => _text('Port Number', '_core.storage'),
            'info'      => _text('Port Number [Info]', '_core.storage'),
            'maxlength' => 5,
            'value'     => 21,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'timeout',
            'factory'   => 'text',
            'label'     => _text('Connection Timeout', '_core.storage'),
            'info'      => _text('Connection Timeout [Info]', '_core.storage'),
            'maxlength' => 5,
            'value'     => 30,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'username',
            'factory'   => 'text',
            'label'     => _text('Username', '_core.storage'),
            'info'      => _text('Username [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'password',
            'factory'   => 'text',
            'label'     => _text('Password', '_core.storage'),
            'info'      => _text('Password [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);


        $this->addElement([
            'name'      => 'basePath',
            'factory'   => 'text',
            'label'     => _text('Base Path', '_core.storage'),
            'info'      => _text('Base Path [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'baseUrl',
            'factory'   => 'text',
            'label'     => _text('Base Url', '_core.storage'),
            'info'      => _text('Base Url [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'baseCdnUrl',
            'factory'   => 'text',
            'label'     => _text('Base CDN Url', '_core.storage'),
            'info'      => _text('Base CDN Url [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => false,
        ]);

        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'radio',
            'inline'   => false,
            'value'    => 0,
            'label'    => _text('Is Active', '_core.storage'),
            'options'  => \Phpfox::get('core.storage')->getActiveIdOptions(),
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
            'href'       => _url('admin.core.storage'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Ftp <b>' . $data['host'] . ':' . $data['port'] .'</b>';
    }
}