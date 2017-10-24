<?php

namespace Neutron\Core\Form\Admin\MailTemplate;

use Phpfox\Form\Form;

class EditMailTemplate extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Mail Template', '_core.mail_template'));
        $this->setInfo(_text('Edit Mail Template [Info]', '_core.mail_template'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `id` #identity **/

        /** element `package_id` **/
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', '_core.mail_template'),
            'info'      => _text('Package Id [Info]', '_core.mail_template'),
            'options'   => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `code` **/
        $this->addElement([
            'name'      => 'code',
            'factory'   => 'text',
            'label'     => _text('Code Id', '_core.mail_template'),
            'info'      => _text('Code Id [Info]', '_core.mail_template'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `vars` **/
        $this->addElement([
            'name'      => 'vars',
            'factory'   => 'textarea',
            'label'     => _text('Placeholders', '_core.mail_template'),
            'info'      => _text('Placeholders [Info]', '_core.mail_template'),
            'maxlength' => 255,
            'required'  => true,
        ]);
        /** end elements **/

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
