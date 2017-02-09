<?php
namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class StorageAdapter extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'storage_adapter';
    }

    /**
     * @return mixed|null
     */
    public function getAdapterId()
    {
        return $this->__get('adapter_id');
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('adapter_id');
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
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
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
    public function setDriverId($value)
    {
        $this->__set('driver_id', (string)$value);
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
    public function getParams()
    {
        return $this->__get('params');
    }

    /**
     * @return mixed|null
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return mixed|null
     */
    public function isDefault()
    {
        return $this->__get('is_default');
    }

    /**
     * @return mixed|null
     */
    public function isFallback()
    {
        return $this->__get('is_fallback');
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
    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    /**
     * @param $value
     */
    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }

    /**
     * @param $value
     */
    public function setFallback($value)
    {
        $this->__set('is_fallback', $value ? 1 : 0);
    }
}