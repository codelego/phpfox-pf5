<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class SystemDriverSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('System Driver Settings', 'admin.core_mail'));
        $this->setInfo(_text('[System Driver Settings Info]', 'admin.core_mail'));

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'fromAddress',
            'label'      => _text('From Address', 'admin'),
            'placeholder' => 'your@domain.com',
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'fromName',
            'factory'    => 'text',
            'label'      => _text('From Name', 'admin'),
            'placeholder' => 'Admin',
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'replyAddress',
            'factory'    => 'text',
            'label'      => _text('Reply To Address', 'admin'),
            'placeholder' => 'no-reply@domain.com',
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'replyName',
            'factory'    => 'text',
            'label'      => _text('Reply To Name', 'admin'),
            'placeholder' => 'No-Reply',
            'value'      => '',
            'required'   => true,
        ]);
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}