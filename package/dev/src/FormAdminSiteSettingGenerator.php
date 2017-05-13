<?php

namespace Neutron\Dev;

class FormAdminSiteSettingGenerator extends FormAdminGenerator
{
    protected $formType = 'Edit';

    protected $template = 'dev/template/form-admin-site-settings-class';

    /**
     * @return string
     */
    public function getShortFormClass()
    {
        $string = $this->formType . ' ' . str_replace('_', ' ', $this->tableName).'Settings';

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