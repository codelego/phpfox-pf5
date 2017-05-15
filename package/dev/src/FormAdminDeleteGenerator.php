<?php

namespace Neutron\Dev;

class FormAdminDeleteGenerator extends FormAdminGenerator
{
    protected $formType = 'Delete';

    protected $template = 'dev/template/form-admin-delete-class';

    protected function getElementGeneratorParams()
    {
        return [
            'noNote'     => true,
            'textDomain' => $this->meta->getTextDomain(),
            'packageId'  => $this->meta->getPackageId(),
        ];
    }
}