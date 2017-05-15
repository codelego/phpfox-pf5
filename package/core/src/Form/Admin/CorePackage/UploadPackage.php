<?php

namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

class UploadPackage extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Import Package', '_core.package'));
        $this->setInfo(_text('[Import Package Info]', '_core.package'));
        $this->setAction(_url('#'));
        $this->setEncType('upload');

        $this->addElements([
            [
                'factory'    => 'file',
                'name'       => 'package',
                'attributes' => [
                    'class'    => 'upload',
                    'accept'   => 'application/zip',
                    'multiple' => true,
                ],
            ],
        ]);

        $this->addButton([
            'name'       => 'save',
            'label'      => _text('Upload'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'name'       => 'cancel',
            'href'       => _url('admin.core.package'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel'],
        ]);
    }
}