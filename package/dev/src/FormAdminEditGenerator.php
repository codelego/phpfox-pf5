<?php

namespace Neutron\Dev;

class FormAdminEditGenerator extends FormAdminGenerator
{

    protected $formType = 'Edit';

    protected $template = 'dev/template/form-admin-edit-class';
    protected function getElementGeneratorParams()
    {
        return [
            'noNote'     => true,
        ];
    }
}