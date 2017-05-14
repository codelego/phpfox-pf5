<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditLogSettings extends Form
{

    protected function initialize()
    {
        $this->setTitle(_text('Log Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__main_log',
            'value'    => [1],
            'options'  => _service('core.log')->getAdapterIdOptions('main.log'),
            'label'    => _text('Main Log', 'admin'),
            'note'     => _text('[Main Log Note]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__mail_log',
            'value'    => [3],
            'options'  => _service('core.log')->getAdapterIdOptions('mail.log'),
            'label'    => _text('Mail Log', 'admin'),
            'note'     => _text('[Mail Log Note]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'multi_checkbox',
            'name'     => 'core__debug_log',
            'value'    => [5],
            'options'  => _service('core.log')->getAdapterIdOptions('debug.log'),
            'label'    => _text('Debug Log', 'admin'),
            'note'     => _text('[Debug Log Note]', 'admin'),
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