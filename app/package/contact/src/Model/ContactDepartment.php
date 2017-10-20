<?php

namespace Neutron\Contact\Model;

use Phpfox\Db\DbModel;

class ContactDepartment extends DbModel
{
    public function getModelId()
    {
        return 'contact_department';
    }

    public function getDepartmentId()
    {
        return (int)$this->__get('department_id');
    }

    public function getId()
    {
        return (int)$this->__get('department_id');
    }

    public function setDepartmentId($value)
    {
        $this->__set('department_id', $value);
    }

    public function setId($value)
    {
        $this->__set('department_id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getEmail()
    {
        return $this->__get('email');
    }

    public function setEmail($value)
    {
        $this->__set('email', $value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function isDefault()
    {
        return $this->__get('is_default') ? 1 : 0;
    }

    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }
}