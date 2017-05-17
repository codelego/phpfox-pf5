<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditLogSettings extends Form
{
    /** lock */
    protected function initialize()
    {
        $this->setTitle(_text('Edit Log Settings', '_core.log_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__main_log',
            'value'    => [1],
            'options'  => _get('core.log')->getAdapterIdOptions('main.log'),
            'label'    => _text('Main Log', 'admin'),
            'info'     => _text('[Main Log Info]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__mail_log',
            'value'    => [3],
            'options'  => _get('core.log')->getAdapterIdOptions('mail.log'),
            'label'    => _text('Mail Log', 'admin'),
            'info'     => _text('[Mail Log Info]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__debug_log',
            'value'    => [5],
            'options'  => _get('core.log')->getAdapterIdOptions('debug.log'),
            'label'    => _text('Debug Log', 'admin'),
            'info'     => _text('[Debug Log Info]', 'admin'),
            'required' => true,
        ]);

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