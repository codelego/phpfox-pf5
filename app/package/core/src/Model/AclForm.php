<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclForm extends DbModel
{
    public function getModelId()
    {
        return 'acl_form';
    }

    public function getFormId()
    {
        return $this->__get('form_id');
    }

    public function getId()
    {
        return $this->__get('form_id');
    }

    public function setFormId($value)
    {
        $this->__set('form_id', $value);
    }

    public function setId($value)
    {
        $this->__set('form_id', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getFormName()
    {
        return $this->__get('form_name');
    }

    public function setFormName($value)
    {
        $this->__set('form_name', $value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
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