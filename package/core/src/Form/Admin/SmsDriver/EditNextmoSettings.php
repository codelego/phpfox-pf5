<?php

namespace Neutron\Core\Form\Admin\SmsDriver;


use Phpfox\Form\Form;

class EditNextmoSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Nextmo Service Settings', 'admin.core_verify_nextmo'));
        $this->setInfo(_text('[Nextmo Service Settings Info]', 'admin.core_verify'));

        $this->addElement([
            'name'      => 'account_id',
            'factory'   => 'text',
            'label'     => _text('Account ID', 'admin.core_verify_nextmo'),
            'info'      => _text('[Account ID Info]', 'admin.core_verify_nextmo'),
            'maxlength' => 100,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'auth_token',
            'factory'   => 'text',
            'label'     => _text('Auth Token', 'admin.core_verify_nextmo'),
            'info'      => _text('[Auth Token Info]', 'admin.core_verify_nextmo'),
            'maxlength' => 100,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'phone_number',
            'factory'   => 'text',
            'label'     => _text('Phone Number', 'admin.core_verify_nextmo'),
            'info'      => _text('[Phone Number Info]', 'admin.core_verify_nextmo'),
            'maxlength' => 100,
            'required'  => true,
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
            'href'       => _url('admin.core.sms'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);


    }
}