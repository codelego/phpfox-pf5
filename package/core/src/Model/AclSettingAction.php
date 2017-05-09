<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclSettingAction extends DbModel
{
    public function getModelId()
    {
        return 'acl_setting_action';
    }

    public function getId()
    {
        return $this->__get('action_id');
    }

    public function setId($value)
    {
        $this->__set('action_id', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getGroupId()
    {
        return $this->__get('group_id');
    }

    public function setGroupId($value)
    {
        $this->__set('group_id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getPhraseVarName()
    {
        return $this->__get('phrase_var_name');
    }

    public function setPhraseVarName($value)
    {
        $this->__set('phrase_var_name', $value);
    }

    public function getValueActual()
    {
        return $this->__get('value_actual');
    }

    public function setValueActual($value)
    {
        $this->__set('value_actual', $value);
    }

    public function getPriority()
    {
        return $this->__get('priority');
    }

    public function setPriority($value)
    {
        $this->__set('priority', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

}