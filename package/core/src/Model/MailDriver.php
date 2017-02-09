<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class MailDriver extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'mail_driver';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('driver_id');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return mixed
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
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->__get('driver_id');
    }
}