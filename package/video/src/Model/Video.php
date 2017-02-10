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
        return 'video';
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('title', (string)$value);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->__get('video_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('video_id', (int)$value);
    }

    /**
     * @return int
     */
    public function getVideoId()
    {
        return $this->__get('video_id');
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value)
    {
        $this->__set('category_id', (int)$value);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', (string)$value);
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', (int)$value);
    }

    /**
     * @return mixed
     */
    public function getPosterId()
    {
        return (int)$this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value)
    {
        $this->__set('poster_id', (int)$value);
    }

    /**
     * @return mixed
     */
    public function getPosterType()
    {
        return $this->__get('poster_type');
    }


    /**
     * @param $value
     */
    public function setPosterType($value)
    {
        $this->__set('poster_type', (string)$value);
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value)
    {
        $this->__set('parent_id', (int)$value);
    }

    /**
     * @return mixed
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value)
    {
        $this->__set('parent_type', (string)$value);
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
     * @return int
     */
    public function isApproval()
    {
        return $this->__get('is_approval') ? 1 : 0;
    }

    /**
     * @param mixed $value
     */
    public function setApproved($value)
    {
        $this->__set('is_approval', $value ? 1 : 0);
    }

    /**
     * @return string
     */
    public function getProviderId()
    {
        return $this->__get('provider_id');
    }

    /**
     * @param string $value
     */
    public function setProviderId($value)
    {
        $this->__set('provider_id', (string)$value);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @param string $value
     */
    public function setDescription($value)
    {
        $this->__set('description', (string)$value);
    }
}