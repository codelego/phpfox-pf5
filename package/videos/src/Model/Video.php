<?php
namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class Video extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'video_id';
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->__get('title');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->__get('category_id');
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->__get('created');
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @return mixed
     */
    public function getPosterId()
    {
        return $this->__get('poster_id');
    }

    /**
     * @return mixed
     */
    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @return mixed
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
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
    public function isApproved()
    {
        return (bool)$this->__get('is_approved');
    }

    /**
     * @return string
     */
    public function getDriverId()
    {
        return (string)$this->__get('driver_id');
    }
}