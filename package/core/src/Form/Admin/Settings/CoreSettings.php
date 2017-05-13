<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class CoreSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('General Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        /** start elements */

        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'core__site_offline',
            'value'    => 0,
            'label'    => _text('Site Offline?', 'admin'),
            'info'     => _text('[Site offline Info]', 'admin'),
            'options'  => [
                ['value' => 0, 'label' => 'Online'],
                ['value' => 1, 'label' => 'Offline, prevent visitors from accessing your site.'],
            ],
            'required' => true,
        ]);


        $this->addElement([
            'factory'  => 'text',
            'name'     => 'core__offline_code',
            'value'    => '',
            'label'    => _text('Offline Code', 'admin'),
            'info'     => _text('[Offline Code Info]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__full_ajax_mode',
            'value'    => 0,
            'label'    => _text('Full Ajax Mode', 'admin'),
            'info'     => _text('[Full Ajax Mode Info]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'info'     => _text('[private network]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'info'     => _text('[Private Network Info]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__bundlejs',
            'value'    => 0,
            'label'    => _text('Enable Bundle JavaScripts', 'core'),
            'info'     => _text('[Private Network Info]', 'core'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__bundlecss',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core'),
            'info'     => _text('[Private Network Info]', 'core'),
            'required' => true,
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