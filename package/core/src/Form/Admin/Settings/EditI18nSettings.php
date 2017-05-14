<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditI18nSettings extends Form
{

    protected function initialize()
    {
        $this->setTitle(_text('International Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__default_timezone_id',
            'value'    => 'Europe/London',
            'options'  => _get('core.i18n')->getTimezoneIdOptions(),
            'label'    => _text('Default Timezone', 'admin'),
            'note'     => _text('[Default Timezone Note]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__locale_id',
            'value'    => 'en',
            'options'  => _get('core.i18n')->getLocaleIdOptions(),
            'label'    => _text('Default Locale', 'admin'),
            'note'     => _text('[Default Locale Note]', 'admin'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__default_currency_id',
            'value'    => 'USD',
            'options'  => _get('core.i18n')->getCurrencyIdOptions(),
            'label'    => _text('Default Currency', 'admin'),
            'note'     => _text('[Default Currency Note]', 'admin'),
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