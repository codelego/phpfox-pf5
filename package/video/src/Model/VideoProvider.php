<?php

namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class VideoProvider extends DbModel
{
    public function getModelId()
    {
        return 'video_provider';
    }

    public function getId()
    {
        return $this->__get('provider_id');
    }

    public function setId($value)
    {
        $this->__set('provider_id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
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

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }

    public function getProviderClass()
    {
        return $this->__get('provider_class');
    }

    public function setProviderClass($value)
    {
        $this->__set('provider_class', $value);
    }

}