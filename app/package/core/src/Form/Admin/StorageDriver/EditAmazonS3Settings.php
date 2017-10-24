<?php

namespace Neutron\Core\Form\Admin\StorageDriver;


use Phpfox\Form\Form;

class EditAmazonS3Settings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Amazon S3 Storage Settings', '_core.storage'));
        $this->setAction(_url('#'));

        $this->addElement([
            'name'      => 'accessKey',
            'factory'   => 'text',
            'label'     => _text('Amazon Access Key', '_core.storage'),
            'info'      => _text('Amazon Access Key [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'secretKey',
            'factory'   => 'text',
            'label'     => _text('Amazon Secret Key', '_core.storage'),
            'info'      => _text('Amazon Secret Key [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'budget',
            'factory'   => 'text',
            'label'     => _text('Amazon Budget', '_core.storage'),
            'info'      => _text('Amazon Budget [Info]', '_core.storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'region',
            'factory'   => 'select',
            'label'     => _text('Amazon Region', '_core.storage'),
            'info'      => _text('Amazon Region [Info]', '_core.storage'),
            'maxlength' => 500,
            'options'   => \Phpfox::get('core.storage')->getS3RegionIdOptions(),
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
        $data['title'] = 'S3 bucket ' . $data['budget'] . ' - region ' . $data['region'];
    }
}