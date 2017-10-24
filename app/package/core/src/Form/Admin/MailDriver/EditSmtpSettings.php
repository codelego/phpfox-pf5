<?php

namespace Neutron\Core\Form\Admin\MailDriver;

use Phpfox\Form\Form;

class EditSmtpSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Edit SMTP Settings', '_core.mail'));
        $this->setInfo(_text('Edit SMTP Settings [Info]', '_core.mail'));
        $this->setAction(_url('#'));

        $this->addElement([
            'name'     => 'host',
            'factory'  => 'text',
            'label'    => _text('SMTP Server', '_core.mail'),
            'info'     => _text('SMTP Server [Info]', '_core.mail'),
            'value'    => '127.0.0.1',
            'required' => true,
        ]);

        $this->addElement([
            'name'     => 'secure',
            'factory'  => 'radio',
            'label'    => _text('SMTP Security?', '_core.mail'),
            'info'     => _text('SMTP Security [Info]', '_core.mail'),
            'value'    => 'none',
            'required' => true,
            'options'  => [
                ['label' => 'None', 'value' => 'none'],
                ['label' => 'TLS', 'value' => 'tls'],
                ['label' => 'SSL', 'value' => 'ssl'],
            ],
        ]);

        $this->addElement([
            'name'     => 'port',
            'factory'  => 'text',
            'label'    => _text('SMTP Port'),
            'info'     => _text('SMTP Port [Info]', '_core.mail'),
            'value'    => '25',
            'required' => true,
        ]);

        $this->addElement([
            'name'     => 'auth',
            'factory'  => 'radio',
            'label'    => _text('SMTP Authentication', '_core.mail'),
            'info'     => _text('SMTP Authentication [Info]', '_core.mail'),
            'value'    => '0',
            'required' => true,
            'options'  => [
                ['value' => 0, 'label' => _text('No, does not authentication', '_core.mail'),],
                ['value' => 1, 'label' => _text('Yes, use authentication', '_core.mail')],
            ],
        ]);
        $this->addElement([
            'name'     => 'username',
            'factory'  => 'text',
            'label'    => _text('SMTP Login Username', '_core.mail'),
            'info'     => _text('SMTP Login Username [Info]', '_core.mail'),
            'value'    => '',
            'required' => false,
        ]);
        $this->addElement([
            'name'     => 'password',
            'factory'  => 'password',
            'label'    => _text('SMTP Login Password', '_core.mail'),
            'info'     => _text('SMTP Login Password [Info]', '_core.mail'),
            'value'    => '',
            'required' => false,
        ]);

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
        $data['title'] = 'SMTP send from <b>' . $data['host'] . ':' . $data['port'] .'</b>';
    }
}