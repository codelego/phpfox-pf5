<?php

namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class VideoProvider extends DbModel
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
        return $this->__get('driver_name');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('driver_name');
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->__get('driver_id');
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
    public function getDescription()
    {
        return $this->__get('driver_description');
    }

    /**
     * @return mixed
     */
    public function getFormSettings()
    {
        return $this->__get('form_settings');
    }
}