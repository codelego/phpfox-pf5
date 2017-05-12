<?php

namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;
use Phpfox\Form\InputRadioField;

class DevAction extends DbModel
{
    public function getModelId()
    {
        return 'dev_action';
    }

    public function getMetaId()
    {
        return (int)$this->__get('meta_id');
    }

    public function getId()
    {
        return (int)$this->__get('meta_id');
    }

    public function setMetaId($value)
    {
        $this->__set('meta_id', $value);
    }

    public function setId($value)
    {
        $this->__set('meta_id', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getTableName()
    {
        return $this->__get('table_name');
    }

    public function setTableName($value)
    {
        $this->__set('table_name', $value);
    }

    public function getActionType()
    {
        return $this->__get('action_type');
    }

    public function setActionType($value)
    {
        $this->__set('action_type', $value);
    }

    public function getActionId()
    {
        return $this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    public function getTextDomain()
    {
        return $this->__get('text_domain');
    }

    public function setTextDomain($value)
    {
        $this->__set('text_domain', $value);
    }


    public function getActionName()
    {
        switch ($this->getActionType()) {
            case 'admin_add':
                return "<strong>Admin Add</strong> `{$this->getTableName()}`";
            case 'admin_edit':
                return "<strong>Admin Edit</strong> `{$this->getTableName()}`";
            case 'admin_delete':
                return "<strong>Admin Delete</strong> `{$this->getTableName()}`";
            case 'admin_filter':
                return "<strong>Admin Filter</strong> `{$this->getTableName()}`";
            case 'admin_acl_settings':
                return "<strong>Admin Acl Settings</strong> `{$this->getTableName()}`";
            case 'model_class':
                return "Model `{$this->getTableName()}`";
        }
    }

    public function toFormControl()
    {
        $select = new InputRadioField([
            'name'     => 'actions[' . $this->getId() . ']',
            'value'    => $this->getActionId(),
            'required' => true,
            'inline'   => true,
            'options'  => [
                ['value' => 'skip', 'label' => 'Nothing'],
                ['value' => 'delete', 'label' => 'Delete'],
                ['value' => 'create', 'label' => 'Create'],
                ['value' => 'refresh', 'label' => 'Re-Create'],
            ],
        ]);

        return $select->toHtml();
    }
}