<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class StorageDriver extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'storage_driver';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('driver_id');
    }

    /**
     * @return mixed|null
     */
    public function getDriverId()
    {
        return $this->__get('driver_id');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return mixed|null
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value)
    {
        $this->__set('description', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getFormName()
    {
        return $this->__get('form_name');
    }

    /**
     * @param $value
     */
    public function setFormName($value)
    {
        $this->__set('form_name', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? '1' : '0');
    }
}