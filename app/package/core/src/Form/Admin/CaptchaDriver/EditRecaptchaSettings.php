<?php

namespace Neutron\Core\Form\Admin\CaptchaDriver;

use Phpfox\Form\Form;

class EditRecaptchaSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('ReCaptcha Settings', '_core.recaptcha'));
        $this->setInfo(_text('ReCaptcha Settings [Info]', '_core.recaptcha'));
        $this->setAction(_url('#'));

        /** start elements */
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'site_key',
            'value'      => '',
            'label'      => _text('Site Key', '_core.recaptcha'),
            'info'       => _text('Site Key [Info]', '_core.recaptcha'),
            'maxlength'  => 255,
            'spellcheck' => 'false',
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'secret_key',
            'value'      => '',
            'label'      => _text('Secret Key', '_core.recaptcha'),
            'info'       => _text('Secret Key [Info]', '_core.recaptcha'),
            'maxlength'  => 255,
            'spellcheck' => 'false',
            'required'   => true,
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
            'href'       => _url('admin.core.captcha'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);

    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Google ReCaptcha';
    }
}