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
        return $this->__get('driver_id');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->__get('driver_description');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('driver_title');
    }

    /**
     * @return mixed
     */
    public function getFormSettings()
    {
        return $this->__get('form_settings');
    }

    /**
     * @return bool
     */
    public function isActive()
    {

        return (bool)$this->__get('is_active');
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->__get('driver_id');
    }
}