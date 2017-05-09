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
            'factory'    => 'text',
            'name'       => 'fromAddress',
            'label'      => _text('From Address', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'your@domain.com',
            ],
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'fromName',
            'factory'    => 'text',
            'label'      => _text('From Name', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Admin',
            ],
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'replyAddress',
            'factory'    => 'text',
            'label'      => _text('Reply To Address', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'no-reply@domain.com',
            ],
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'replyName',
            'factory'    => 'text',
            'label'      => _text('Reply To Name', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'No-Reply',
            ],
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'host',
            'factory'    => 'text',
            'label'      => _text('Server Address'),
            'attributes' => ['class' => 'form-control'],
            'value'      => '127.0.0.1',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'port',
            'factory'    => 'text',
            'label'      => _text('Server Port'),
            'value'      => '25',
            'note'       => 'Default: 25. Also commonly on port 465 (SMTP over SSL) or port 587.',
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);
        $this->addElement([
            'name'       => 'security',
            'factory'    => 'radio',
            'label'      => _text('Security?'),
            'value'      => 'none',
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
            'options'    => [
                ['label' => 'None', 'value' => 'none'],
                ['label' => 'TLS', 'value' => 'tls'],
                ['label' => 'SSL', 'value' => 'ssl'],
            ],
        ]);
        $this->addElement([
            'name'       => 'authentication',
            'factory'    => 'radio',
            'label'      => _text('Authentication?'),
            'info'       => _text('Does your SMTP Server require authentication?', 'admin'),
            'value'      => '0',
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
            'options'    => [
                ['label' => _text('No, does not authentication'), 'value' => 0,],
                ['label' => _text('Yes, use authentication'), 'value' => 1],
            ],
        ]);
        $this->addElement([
            'name'       => 'username',
            'factory'    => 'text',
            'label'      => _text('SMTP Username'),
            'value'      => '',
            'attributes' => ['class' => 'form-control'],
            'required'   => false,
        ]);
        $this->addElement([
            'name'       => 'password',
            'factory'    => 'password',
            'label'      => _text('SMTP Password'),
            'value'      => '',
            'attributes' => ['class' => 'form-control'],
            'required'   => false,
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