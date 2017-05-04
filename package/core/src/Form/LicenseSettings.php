<?php

namespace Neutron\Core\Form;


use Phpfox\Form\Button;
use Phpfox\Form\Form;

class LicenseSettings extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'license_email',
                'label'      => _text('License Email'),
                'attributes' => ['class' => 'form-control'],
                'value'      => '',
                'required'   => true,
            ],
            [
                'factory'    => 'text',
                'name'       => 'license_key',
                'label'      => _text('License Key'),
                'attributes' => ['class' => 'form-control'],
                'value'      => '',
                'required'   => true,
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}