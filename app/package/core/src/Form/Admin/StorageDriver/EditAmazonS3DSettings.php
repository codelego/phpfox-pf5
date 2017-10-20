<?php

namespace Neutron\Core\Form\Admin\StorageDriver;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditAmazonS3DSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Amazon S3 Storage Settings', 'admin.core_storage'));
        $this->setInfo(_text('[Amazon S3 Storage Settings Note]', 'admin.core_storage'));
        $this->setAction(_url('#'));

        $this->addElement([
            'name'      => 'accessKey',
            'factory'   => 'text',
            'label'     => _text('Amazon Access Key', 'admin.core_storage'),
            'note'      => _text('[Amazon Access Key Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'secretKey',
            'factory'   => 'text',
            'label'     => _text('Amazon Secret Key', 'admin.core_storage'),
            'note'      => _text('[Amazon Secret Key Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'budget',
            'factory'   => 'text',
            'label'     => _text('Amazon Budget', 'admin.core_storage'),
            'note'      => _text('[Amazon Budget Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'region',
            'factory'   => 'select',
            'label'     => _text('Amazon Region', 'admin.core_storage'),
            'note'      => _text('[Amazon Region Note]', 'admin.core_storage'),
            'maxlength' => 500,
            'options'   => \Phpfox::get('core.storage')->getS3RegionIdOptions(),
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
        $data['title'] = 'S3 bucket ' . $data['budget'] . ' - region ' . $data['region'];
    }
}