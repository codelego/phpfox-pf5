<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditI18nSettings extends Form
{
    /** lock */
    protected function initialize()
    {
        $this->setTitle(_text('International Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__default_timezone_id',
            'value'    => 'Europe/London',
            'options'  => _get('core.i18n')->getTimezoneIdOptions(),
            'label'    => _text('Default Timezone', '_core.i18n'),
            'info'     => _text('[Default Timezone Info]', '_core.i18n'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__locale_id',
            'value'    => 'en',
            'options'  => _get('core.i18n')->getLocaleIdOptions(),
            'label'    => _text('Default Locale', '_core.i18n'),
            'info'     => _text('[Default Locale Info]', '_core.i18n'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__default_currency_id',
            'value'    => 'USD',
            'options'  => _get('core.i18n')->getCurrencyIdOptions(),
            'label'    => _text('Default Currency', '_core.i18n'),
            'info'     => _text('[Default Currency Info]', '_core.i18n'),
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