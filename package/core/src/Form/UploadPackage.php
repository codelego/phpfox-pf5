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