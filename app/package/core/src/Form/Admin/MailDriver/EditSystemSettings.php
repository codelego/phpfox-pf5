<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Phpfox\Form\Form;

class EditSystemSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('System Driver Settings', '_core.mail'));
        $this->setInfo(_text('System Driver Settings [Info]', '_core.mail'));
        $this->setAction(_url('#'));

        $this->addElement([
            'factory'     => 'text',
            'name'        => 'fromAddress',
            'label'       => _text('From Address', '_core.mail'),
            'info'        => _text('From Address [Info]', '_core.mail'),
            'placeholder' => 'your@domain.com',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'fromName',
            'factory'     => 'text',
            'label'       => _text('From Name', '_core.mail'),
            'info'        => _text('From Name [Info]', '_core.mail'),
            'placeholder' => 'Admin',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'replyAddress',
            'factory'     => 'text',
            'label'       => _text('Reply to Address', '_core.mail'),
            'info'        => _text('Reply to Address [Info]', '_core.mail'),
            'placeholder' => 'no-reply@domain.com',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'replyName',
            'factory'     => 'text',
            'label'       => _text('Reply to Name', '_core.mail'),
            'info'        => _text('Reply to Name [Info]', '_core.mail'),
            'placeholder' => 'No-Reply',
            'value'       => '',
            'required'    => true,
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
            'href'       => _url('admin.core.mail.adapter'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'System mail send from <b>'.$data['fromAddress'].'</b>';
    }
}