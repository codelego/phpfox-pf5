<?php

namespace Phpfox\RapidDev;

class FormAdminEditGenerator extends FormAdminGenerator
{

    protected $formType =  'Edit';

    /**
     * @return string
     */
    public function process()
    {
        $tableInfo = new TableInfo($this->tableName);

        $elements = [];
        $formElement = new FormElement($this->metadata);

        foreach ($tableInfo->getColumns() as $column) {
            $elements[] = $formElement->convert($column);
        }

        $namespace = $this->getNameSpace();
        $shortFormClass = $this->getShortFormClass();
        $fullFormClass = $this->getFullFormClass();
        $formTitle = $this->getFormTitle();
        $packageInfo = $this->getPackageInfo();
        $component = $this->getComponent();

        $modulePath = $packageInfo['path'];
        $formClassPath = $modulePath . '/src/Form/Admin/' . $component . '/'. $shortFormClass . '.php';

        $formCode = $this->translate('form_admin_edit_class.txt', [
            'fullFormClass' => $fullFormClass,
            'namespace'     => $namespace,
            'component'      => $component,
            'shortFormClass'      => $shortFormClass,
            'initialize'    => $this->fixTab(8, implode(PHP_EOL, $elements)),
            'heading'       => 'Table to Form',
            'tableName'     => $this->tableName,
            'moduleName'    => $this->packageId,
            'formType'      => $this->formType,
            'textDomain'    => $this->textDomain,
            'formTitle'     => $formTitle,
        ]);


        $this->putContents($formClassPath, $formCode);
    }

}