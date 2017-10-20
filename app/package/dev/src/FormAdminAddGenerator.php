<?php

namespace Neutron\Dev;

class FormAdminAddGenerator extends FormAdminGenerator
{
    protected $formType = 'Add';

    protected $template = 'dev/template/form-admin-add-class';

    protected function getElementGeneratorParams()
    {
        return [
            'noNote'     => true,
            'textDomain' => $this->meta->getTextDomain(),
            'packageId'  => $this->meta->getPackageId(),
        ];
    }
}