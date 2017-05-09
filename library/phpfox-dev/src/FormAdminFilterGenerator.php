<?php

namespace Phpfox\RapidDev;

class FormAdminFilterGenerator extends FormAdminGenerator
{
    protected $formType = 'Filter';

    /**
     * @return string
     */
    public function process()
    {
        $tableInfo = new TableInfo($this->tableName);

        $elements = [];

        $formElement = new FormElement($this->metadata);
        $formElement->setNoNote(true);
        $formElement->setNoDefault(true);
        $formElement->setNoRadio(true);
        $formElement->setNoTextarea(true);

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
        $formClassPath = $modulePath . '/src/Form/Admin/' . $component . '/' . $shortFormClass . '.php';

        $formCode = $this->translate('form_admin_filter_class.txt', [
            'fullFormClass'  => $fullFormClass,
            'namespace'      => $namespace,
            'component'      => $component,
            'shortFormClass' => $shortFormClass,
            'initialize'     => $this->fixTab(8, implode(PHP_EOL, $elements)),
            'heading'        => 'Table to Form',
            'tableName'      => $this->tableName,
            'moduleName'     => $this->packageId,
            'formType'       => $this->formType,
            'textDomain'     => $this->textDomain,
            'formTitle'      => $formTitle,
        ]);


        $this->putContents($formClassPath, $formCode);
    }
}