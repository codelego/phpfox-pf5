<?php

namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class Provider extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'video_provider';
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
    public function getId()
    {
        return $this->__get('provider_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('provider_id', $value);
    }

    /**
     * @return mixed|null
     */
    public function getProviderClass()
    {
        return $this->__get('provider_class');
    }

    /**
     * @param $value
     */
    public function setProviderClass($value)
    {
        $this->__set('provider_class', (string)$value);
    }

    /**
     * @return mixed|null
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
}