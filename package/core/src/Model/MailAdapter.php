<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class MailAdapter extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'mail_adapter';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('adapter_id');
    }

    /**
     * @return mixed
     */
    public function getAdapterId()
    {
        return $this->__get('adapter_id');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        $title = $this->__get('name');

        if (!$title) {
            $title = $this->getDriverId() . ' #' . $this->getId();
        }

        return $title;
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getName();
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->__get('is_default') ? 1 : 0;
    }

    /**
     * @param $value
     */
    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->__get('driver_id');
    }

    /**
     * @param $value
     */
    public function setDriverId($value)
    {
        $this->__set('driver_id', (string)$value);
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->__get('params');
    }

    /**
     * @param $value
     */
    public function setParams($value)
    {
        $this->__set('params', (string)$value);
    }

    /**
     * @param $value
     */
    public function setFallback($value)
    {
        $this->__set('is_fallback', $value ? 1 : 0);
    }

    /**
     * @return mixed|null
     */
    public function isFallback()
    {
        return $this->__get('is_fallback') ? 1 : 0;
    }

    /**
     * @param $value
     */
    public function setDescription($value)
    {
        $this->__set('description', (string)$value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }
}