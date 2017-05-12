<?php

namespace Neutron\Dev;

class FormAdminAclSettingGenerator extends FormAdminGenerator
{
    protected $formType = 'Edit';

    protected $template = 'dev/template/form-admin-acl-settings-class';

    /**
     * @return string
     */
    public function getShortFormClass()
    {
        $string = $this->formType . ' ' . str_replace('_', ' ', $this->tableName).'AclSettings';

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
        ];
    }
}