<?php

namespace Neutron\Core\Form\Admin\MailTemplate;

use Phpfox\Form\Form;

class TranslateMailTemplate extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Mail Template', '_core.mail_template'));
        $this->setInfo(_text('Edit Mail Template [Info]', '_core.mail_template'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `id` #identity **/

        /** element `language_id` **/
        $this->addElement([
            'name'      => 'locale_id',
            'factory'   => 'select',
            'label'     => _text('Locale Id', '_core.mail_template'),
            'info'      => _text('Locale Id [Info]', '_core.mail_template'),
            'options'   => \Phpfox::get('core.i18n')->getLocaleIdOptions(),
            'maxlength' => 255,
            'required'  => false,
        ]);


        /** element `vars` **/
        $this->addElement([
            'name'      => 'subject',
            'factory'   => 'textarea',
            'label'     => _text('Vars', '_core.mail_template'),
            'info'      => _text('Vars [Info]', '_core.mail_template'),
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
