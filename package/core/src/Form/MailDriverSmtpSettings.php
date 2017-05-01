<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class MailDriverSmtpSettings extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'mail__from_address',
                'label'      => _text('From Address', 'admin'),
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'your@domain.com',
                ],
                'value'      => '',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__from_name',
                'label'      => _text('From Name', 'admin'),
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Admin',
                ],
                'value'      => '',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__reply_address',
                'label'      => _text('Reply To Address', 'admin'),
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'no-reply@domain.com',
                ],
                'value'      => '',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__reply_name',
                'label'      => _text('Reply To Name', 'admin'),
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'No-Reply',
                ],
                'value'      => '',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__smtp_host',
                'label'      => _text('Server Address'),
                'attributes' => ['class' => 'form-control'],
                'value'      => '127.0.0.1',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__smtp_port',
                'label'      => _text('Server Port'),
                'value'      => '25',
                'note'       => 'Default: 25. Also commonly on port 465 (SMTP over SSL) or port 587.',
                'attributes' => ['class' => 'form-control'],
                'required'   => true,
            ],
            [
                'factory'    => 'radio',
                'name'       => 'mail__smtp_security',
                'label'      => _text('Security?'),
                'value'      => 'none',
                'attributes' => ['class' => 'form-control'],
                'required'   => true,
                'options'    => [
                    ['label' => 'None', 'value' => 'none'],
                    ['label' => 'TLS', 'value' => 'tls'],
                    ['label' => 'SSL', 'value' => 'ssl'],
                ],
            ],
            [
                'factory'    => 'radio',
                'name'       => 'mail__smtp_authentication',
                'label'      => _text('Authentication?'),
                'info'       => _text('Does your SMTP Server require authentication?',
                    'admin'),
                'value'      => '0',
                'attributes' => ['class' => 'form-control'],
                'required'   => true,
                'options'    => [
                    [
                        'label' => _text('No, does not authentication'),
                        'value' => 0,
                    ],
                    ['label' => _text('Yes, use authentication'), 'value' => 1],
                ],
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__smtp_username',
                'label'      => _text('SMTP Username'),
                'value'      => '',
                'attributes' => ['class' => 'form-control'],
                'required'   => false,
            ],
            [
                'factory'    => 'text',
                'name'       => 'mail__smtp_password',
                'label'      => _text('SMTP Password'),
                'value'      => '',
                'attributes' => ['class' => 'form-control'],
                'required'   => false,
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}