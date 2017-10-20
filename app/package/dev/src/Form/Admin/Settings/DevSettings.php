<?php

namespace Neutron\Dev\Form\Admin\Settings;


use Phpfox\Form\Form;

class DevSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('SEO Settings', 'core_seo'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'dev__default_package_id',
            'value'    => 'core',
            'options'  => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'label'    => "Default Package ID",
            'note'     => "Development for current package.",
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'text',
            'name'     => 'dev__table_prefix',
            'value'    => '',
            'label'    => "Filter Table Prefix",
            'required' => false,
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