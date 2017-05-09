<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ButtonField;
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

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}