<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclValue extends DbModel
{
    public function getModelId()
    {
        return 'acl_value';
    }

    public function getValueId()
    {
        return $this->__get('value_id');
    }

    public function getId()
    {
        return $this->__get('value_id');
    }

    public function setValueId($value)
    {
        $this->__set('value_id', $value);
    }

    public function setId($value)
    {
        $this->__set('value_id', $value);
    }

    public function getInternalId()
    {
        return $this->__get('internal_id');
    }

    public function setInternalId($value)
    {
        $this->__set('internal_id', $value);
    }

    public function getActionId()
    {
        return $this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    public function getValueActual()
    {
        return $this->__get('value_actual');
    }

    public function setValueActual($value)
    {
        $this->__set('value_actual', $value);
    }
}