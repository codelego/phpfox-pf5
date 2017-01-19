<?php

namespace Neutron\Core\Form;


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
                    'class'=>'form-control upload',
                    'accept'=>'application/zip',
                ],
            ],
        ]);
    }
}