<?php

namespace Neutron\Dev;

class FormPermissionGenerator extends FormAdminGenerator
{
    protected $formType = 'Edit';

    protected $template = 'dev/template/form-permission-class';

    /**
     * @return string
     */
    public function getShortFormClass()
    {
        $name = $this->tableName;
        $array = explode('_', $name);
        if (count($array) > 1) {
            array_shift($array);
        }
        $name = implode('_', $array);
        $string = $this->formType . ' ' . str_replace('_', ' ', $name) . 'Permissions';

        return _inflect($string);
    }

    /**
     * @return string
     */
    public function getComponent()
    {
        return 'Settings';
    }

    protected function getElementGeneratorParams()
    {
        return [
            'noNote' => true,
            'textDomain' => $this->meta->getTextDomain(),
            'packageId'=>$this->meta->getPackageId(),
        ];
    }
}