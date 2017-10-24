<?php

namespace Neutron\Core\Form\Admin\SmsDriver;


use Phpfox\Form\Form;

class EditNextmoSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Nextmo Service Settings', '_core.sms_nextmo'));
        $this->setInfo(_text('Nextmo Service Settings [Info]', '_core.sms_nextmo'));

        $this->addElement([
            'name'      => 'api_key',
            'factory'   => 'text',
            'label'     => _text('API Key', '_core.sms_nextmo'),
            'info'      => _text('API Key [Info]', '_core.sms_nextmo'),
            'maxlength' => 100,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'api_secret',
            'factory'   => 'text',
            'label'     => _text('API Secret', '_core.sms_nextmo'),
            'info'      => _text('API Secret [Info]', '_core.sms_nextmo'),
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

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Nextmo <b>' . $data['api_key'] . '</b>';
        $data['is_active'] = 1;
        $data['is_default'] = 0;
        $data['is_required'] = 0;
    }
}