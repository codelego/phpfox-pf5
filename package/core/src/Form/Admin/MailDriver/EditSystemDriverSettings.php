<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Phpfox\Form\Form;

class EditSystemDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('System Driver Settings', 'admin.core_mail'));
        $this->setInfo(_text('[System Driver Settings Info]', 'admin.core_mail'));

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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}