<?php

namespace Neutron\Core\Form;


class AdminSettingsCoreSite extends FormSiteSettings
{
    protected function initialize()
    {
        $this->setTitle(_text('General Settings', 'core_site'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));

        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'core_site__offline',
            'value'    => 0,
            'label'    => _text('Site Offline?', 'core_site'),
            'note'     => _text('[Site offline Note]', 'core_site'),
            'options'  => [
                ['value' => 0, 'label' => 'Online'],
                ['value' => 1, 'label' => 'Offline, prevent visitors from accessing your site.'],
            ],
            'required' => true,
        ]);


        $this->addElement([
            'factory'    => 'text',
            'name'       => 'core_site__offline_code',
            'value'      => '',
            'label'      => _text('Offline Code', 'core_site'),
            'note'       => _text('[Offline Code Note]', 'core_site'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core_site__full_ajax_mode',
            'value'    => 0,
            'label'    => _text('Full Ajax Mode', 'core_site'),
            'note'     => _text('[Full Ajax Mode Note]', 'core_site'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core_site__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'note'     => _text('[private network]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'core_site__private_network',
            'value'    => 0,
            'label'    => _text('Private Network?', 'core_seo'),
            'note'     => _text('[private network]', 'core_seo'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'    => 'select',
            'name'       => 'core_site__default_timezone',
            'value'      => 'Europe/London',
            'options'    => _service('core.timezone')->getTimezoneIdOptions(),
            'label'      => _text('Default Timezone', 'core_site'),
            'note'       => _text('[Default Timezone Note]', 'core_site'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'select',
            'name'       => 'core_site__default_locale',
            'value'      => 'en',
            'options'    => _service('core.language')->getLanguageIdOptions(),
            'label'      => _text('Default Locale', 'core_site'),
            'note'       => _text('[Default Locale Note]', 'core_site'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);
    }
}