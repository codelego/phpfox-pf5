<?php

namespace Neutron\Core\Form\Admin\MailDriver;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class SmtpDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('SMTP Driver Settings', 'admin.core_mail'));
        $this->setInfo(_text('[Mail SMTP Driver Settings Info]', 'admin.core_mail'));

        $this->addElement([
            'name'     => 'host',
            'factory'  => 'text',
            'label'    => _text('SMTP Hostname'),
            'value'    => '127.0.0.1',
            'required' => true,
        ]);

        $this->addElement([
            'name'     => 'secure',
            'factory'  => 'radio',
            'label'    => _text('Security?'),
            'value'    => 'none',
            'required' => true,
            'options'  => [
                ['label' => 'none', 'value' => 'none'],
                ['label' => 'TLS', 'value' => 'tls'],
                ['label' => 'SSL', 'value' => 'ssl'],
            ],
        ]);

        $this->addElement([
            'name'     => 'port',
            'factory'  => 'text',
            'label'    => _text('SMTP Port'),
            'value'    => '25',
            'note'     => 'Default: 25. Also commonly on port 465 (SMTP over SSL) or port 587.',
            'required' => true,
        ]);

        $this->addElement([
            'name'     => 'auth',
            'factory'  => 'radio',
            'label'    => _text('SMTP Authentication'),
            'info'     => _text('Does your SMTP Server require authentication?', 'admin'),
            'value'    => '0',
            'required' => true,
            'options'  => [
                ['value' => 0, 'label' => _text('No, does not authentication'),],
                ['value' => 1, 'label' => _text('Yes, use authentication')],
            ],
        ]);
        $this->addElement([
            'name'     => 'username',
            'factory'  => 'text',
            'label'    => _text('SMTP Login Username'),
            'value'    => '',
            'required' => false,
        ]);
        $this->addElement([
            'name'     => 'password',
            'factory'  => 'password',
            'label'    => _text('SMTP Login Password'),
            'value'    => '',
            'required' => false,
        ]);

        $this->addElement([
            'factory'     => 'text',
            'name'        => 'fromAddress',
            'label'       => _text('From Address', 'admin'),
            'placeholder' => 'your@domain.com',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'fromName',
            'factory'     => 'text',
            'label'       => _text('From Name', 'admin'),
            'placeholder' => 'Admin',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'replyAddress',
            'factory'     => 'text',
            'label'       => _text('Reply To Address', 'admin'),
            'placeholder' => 'no-reply@domain.com',
            'value'       => '',
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'replyName',
            'factory'     => 'text',
            'label'       => _text('Reply To Name', 'admin'),
            'placeholder' => 'No-Reply',
            'value'       => '',
            'required'    => true,
        ]);

    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}