<?php

namespace Neutron\Dev\Service;

use Neutron\Dev\FormAdminAddGenerator;
use Neutron\Dev\FormAdminEditGenerator;
use Neutron\Dev\FormAdminFilterGenerator;
use Neutron\Dev\Model\DevActionMeta;
use Neutron\Dev\ModelGenerator;
use Phpfox\Form\Form;

class CodeGenerator
{
    /**
     * @param $selected
     *
     * @return bool
     */
    public function generate($selected)
    {
        if (empty($selected)) {
            return false;
        }

        $actionMetas = _model('dev_action_meta')
            ->select()
            ->where('meta_id in ?', $selected)
            ->where('action_type <> ?', 'skip')
            ->all();

        foreach ($actionMetas as $actionMeta) {
            $this->process($actionMeta);
        }

        return true;
    }

    /**
     * @param DevActionMeta $actionMeta
     *
     * @return  bool
     */
    public function process(DevActionMeta $actionMeta)
    {
        switch ($actionMeta->getActionType()) {
            case 'admin_add':
                return (new FormAdminAddGenerator($actionMeta))->process();
            case 'admin_edit':
                return (new FormAdminEditGenerator($actionMeta))->process();
            case 'admin_delete':
                break;
            case 'admin_filter':
                return (new FormAdminFilterGenerator($actionMeta))->process();
            case 'model_class':
                return (new ModelGenerator($actionMeta))->process();
        }
    }
    
    /**
     * @param Form $form
     * @param      $tableName
     * @param      $packageId
     *
     * @return bool
     */
    protected function generateModel(Form $form, $packageId, $tableName, $textDomain = null)
    {
        $generator = new ModelGenerator([
            'packageId'  => $packageId,
            'tableName'  => $tableName,
            'textDomain' => $textDomain,
        ]);

        $result = $generator->process();

        $form->addElement([
            'factory'  => 'textarea',
            'name'     => 'model_config',
            'value'    => $result['configCode'],
            'label'    => 'Model Config',
            'info'     => 'put this code to `' . ($result['configPath']) . '`',
            'readonly' => true,
            'onclick'  => 'this.select()',
            'rows'     => 7,
        ]);
        return true;
    }
}