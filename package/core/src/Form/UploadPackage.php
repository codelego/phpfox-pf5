<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class UploadPackage extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'file',
                'name'       => 'package',
                'label'      => 'Upload Package',
                'attributes' => [
                    'class'  => 'form-control upload',
                    'accept' => 'application/zip',
                ],
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}