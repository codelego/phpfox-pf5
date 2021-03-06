<?php

namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class VideoProvider extends DbModel
{
    public function getModelId()
    {
        return 'video_provider';
    }

    public function getProviderId()
    {
        return $this->__get('provider_id');
    }

    public function getId()
    {
        return $this->__get('provider_id');
    }

    public function setProviderId($value)
    {
        $this->__set('provider_id', $value);
    }

    public function setId($value)
    {
        $this->__set('provider_id', $value);
    }

    public function getFormSettingsClass()
    {
        return $this->__get('form_settings_class');
    }

    public function setFormSettingsClass($value)
    {
        $this->__set('form_settings_class', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
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

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    public function getDependency()
    {
        return $this->__get('dependency');
    }

    public function setDependency($value)
    {
        $this->__set('dependency', $value);
    }
}