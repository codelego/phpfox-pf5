<?php

namespace Neutron\Core\Form\Admin\StorageDriver;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditFtpSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('FTP/FTPs Storage Settings', 'admin.core_storage'));
        $this->setInfo(_text('[FTP/FTPs Storage Settings Note]', 'admin.core_storage'));
        $this->setAction(_url('#'));

        $this->addElement([
            'name'     => 'protocol',
            'factory'  => 'radio',
            'inline'   => false,
            'value'    => 0,
            'label'    => _text('Protocol', 'admin.core_storage'),
            'info'     => _text('[Use Ftp Protocol Info]', 'admin.core_storage'),
            'options'  => [
                ['value' => 'ftp', 'label' => 'FTP'],
                ['value' => 'ftps', 'label' => 'FTPs'],
            ],
            'required' => true,
        ]);

        $this->addElement([
            'name'      => 'host',
            'factory'   => 'text',
            'label'     => _text('Ftp Server Host', 'admin.core_storage'),
            'note'      => _text('[Ftp Server Note]', 'admin.core_storage'),
            'value'     => '127.0.0.1',
            'maxlength' => 100,
            'required'  => true,
        ]);


        $this->addElement([
            'name'      => 'port',
            'factory'   => 'text',
            'label'     => _text('Ftp Server Port', 'admin.core_storage'),
            'note'      => _text('[Ftp Server Port Note]', 'admin.core_storage'),
            'maxlength' => 5,
            'value'     => 21,
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
            'maxlength' => 500,
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
        $data['title'] = 'Ftp ' . $data['host'] . ':' . $data['port'];
    }
}