<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class CoreSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('General Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));

        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'core__offline',
            'value'    => 0,
            'label'    => _text('Site Offline?', 'admin'),
            'note'     => _text('[Site offline Note]', 'admin'),
            'options'  => [
                ['value' => 0, 'label' => 'Online'],
                ['value' => 1, 'label' => 'Offline, prevent visitors from accessing your site.'],
            ],
            'required' => true,
        ]);


        $this->addElement([
            'factory'    => 'text',
            'name'       => 'core__offline_code',
            'value'      => '',
            'label'      => _text('Offline Code', 'admin'),
            'note'       => _text('[Offline Code Note]', 'admin'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__full_ajax_mode',
            'value'    => 0,
            'label'    => _text('Full Ajax Mode', 'admin'),
            'note'     => _text('[Full Ajax Mode Note]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'note'     => _text('[private network]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'note'     => _text('[private network]', 'core_seo'),
            'required' => true,
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);

    }
}