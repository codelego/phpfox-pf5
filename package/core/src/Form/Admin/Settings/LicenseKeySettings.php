<?php

namespace Neutron\Core\Form\Admin\Settings;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class LicenseKeySettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('License Settings', 'admin'));
        $this->setInfo(_text('[License Settings Info]', 'admin'));
        $this->setAction(_url('#'));

        $this->addElement([
            'factory'    => 'static',
            'name'       => '_license_id',
            'value'      => _param('core_license', 'level_id'),
            'label'      => _text('License Package', 'admin'),
            'note'       => _text('[License Package Note]', 'admin'),
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'core_license__email',
            'label'      => _text('License Email', 'admin'),
            'note'       => _text('[License Email Note]', 'admin'),
            'value'      => '',
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'core_license__key',
            'label'      => _text('License Key', 'admin'),
            'note'       => _text('[License Key Note]', 'admin'),
            'value'      => '',
            'required'   => true,
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