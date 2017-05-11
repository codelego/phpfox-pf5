<?php

namespace Neutron\Core\Form\Admin\MailAdapter;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class TestEmailSettings extends Form
{
    public function initialize()
    {
        $this->setTitle(_text('Send Test Mail', ''));
        $this->setInfo(_text('[Send Test Mail Info]', ''));
        $this->setAction(_url('#'));
        $this->setAttribute('data-submit', 'admin.i18n.testEmail');

        $conf = _param('test_mail');

        $this->addElement([
            'name'        => 'to',
            'factory'     => 'text',
            'type'        => 'email',
            'label'       => 'To',
            'placeholder' => 'recipient@example.com',
            'value'       => $conf['to'],
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'subject',
            'factory'     => 'text',
            'label'       => 'Subject',
            'placeholder' => 'Example subject',
            'value'       => $conf['subject'],
            'required'    => true,
        ]);

        $this->addElement([
            'name'        => 'message',
            'factory'     => 'textarea',
            'rows'        => 8,
            'label'       => 'Message',
            'placeholder' => 'Example Message',
            'value'       => $conf['message'],
            'required'    => true,
        ]);
    }

    public function getButtons()
    {
        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Send'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
            ]),
        ];
        /** end buttons **/
    }
}