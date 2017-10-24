<?php

namespace Neutron\Core\Form\Admin\SmsDriver;


use Phpfox\Form\Form;

class EditTwilioSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Twilio Service Settings', '_core.twilio_sms'));
        $this->setInfo(_text('Twilio Service Settings [Info]', '_core.twilio_sms'));

        $this->addElement([
            'name'      => 'core_twilio__account_id',
            'factory'   => 'text',
            'label'     => _text('Account ID', '_core.twilio_sms'),
            'info'      => _text('Account ID [Info]', '_core.twilio_sms'),
            'maxlength' => 100,
            'required'  => true,
        ]);

        $this->addElement([
            'name'      => 'core_twilio__auth_token',
            'factory'   => 'text',
            'label'     => _text('Auth Token', '_core.twilio_sms'),
            'info'      => _text('Auth Token [Info]', '_core.twilio_sms'),
            'maxlength' => 100,
            'required'  => true,
        ]);

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
        $data['title'] = 'Twilio <b>' . $data['core_twilio__account_id'] . '</b>';
        $data['is_active'] = 1;
        $data['is_default'] = 0;
        $data['is_required'] = 0;
    }
}