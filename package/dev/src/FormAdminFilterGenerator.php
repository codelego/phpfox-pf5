<?php

namespace Neutron\Dev;

class FormAdminFilterGenerator extends FormAdminGenerator
{
    protected $formType = 'Filter';

    protected $template = 'dev/template/form-admin-filter-class';

    protected function getElementParams()
    {
        return [
            'noLabel'    => false,
            'noNote'     => true,
            'noRequire'  => true,
            'noInfo'     => true,
            'noWrap'     => false,
            'noTextarea' => true,
            'noRadio'    => true,
            'shortLabel' => true,
        ];
    }
}