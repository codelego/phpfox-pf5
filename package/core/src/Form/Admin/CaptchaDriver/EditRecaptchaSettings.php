<?php

namespace Neutron\Core\Form\Admin\CaptchaDriver;

use Phpfox\Form\Form;

class EditRecaptchaSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('ReCaptcha Settings', 'admin.captcha'));
        $this->setInfo(_text('[ReCaptcha Settings Info]', 'admin.captcha'));

        /** start elements */
        $this->addElement([
            'factory'   => 'text',
            'name'      => 'site_key',
            'value'     => '',
            'label'     => _text('Site Key', 'admin.recaptcha'),
            'info'      => _text('[Site Key Info]', 'admin.recaptcha'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        $this->addElement([
            'factory'   => 'text',
            'name'      => 'secret_key',
            'value'     => '',
            'label'     => _text('Secret Key', 'admin.recaptcha'),
            'info'      => _text('[Secret Key Info]', 'admin.recaptcha'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** end elements */

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
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