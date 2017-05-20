<?php

namespace Neutron\Dev;

class FormAdminFilterGenerator extends FormAdminGenerator
{
    protected $formType = 'Filter';

    protected $template = 'dev/template/form-admin-filter-class';

    protected function getElementGeneratorParams()
    {
        return [
            'noLabel'    => true,
            'noNote'     => true,
            'noRequire'  => true,
            'noInfo'     => true,
            'noWrap'     => false,
            'noTextarea' => true,
            'noRadio'    => true,
            'shortLabel' => true,
            'textDomain' => $this->meta->getTextDomain(),
            'packageId'  => $this->meta->getPackageId(),
        ];
    }
}