<?php

namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;
use Phpfox\Form\SelectField;

class RadTableMeta extends DbModel
{
    public function getModelId()
    {
        return 'rad_table_meta';
    }

    public function getId()
    {
        return $this->__get('table_name');
    }

    public function setId($value)
    {
        $this->__set('table_name', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getActionId()
    {
        return $this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    public function toFormControl($formType)
    {
        /** @var RadFormMeta $entry */
        $entry = _model('rad_form_meta')
            ->select()
            ->where('table_name=?', $this->getId())
            ->where('form_type=?', $formType)
            ->first();

        if (!$entry) {
            $entry = _model('rad_form_meta')
                ->create([
                    'table_name' => $this->getId(),
                    'form_type'  => $formType,
                    'value'      => 'skip',
                ]);
            $entry->save();
        }

        $select = new SelectField([
            'value'    => $entry->getActionId(),
            'required' => true,
            'name'     => 'values['.$this->getId().'][' . $formType . ']',
            'options'  => [
                ['value' => 'skip', 'label' => 'Do nothing'],
                ['value' => 'delete', 'label' => 'Delete if exists'],
                ['value' => 'default', 'label' => 'Create if not exists'],
                ['value' => 'refresh', 'label' => 'Refresh'],
            ],
        ]);

        return $select->toHtml();
    }
}