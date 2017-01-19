<?php

namespace Neutron\ContactUs\Model;

use Phpfox\Db\DbModel;

class ContactDepartment extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'contact_department';
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return (bool)$this->__get('is_default');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @return int
     */
    public function getMessageCount()
    {
        return 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('department_id');
    }
}