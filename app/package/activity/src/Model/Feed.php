<?php

namespace Neutron\Activity\Model;

use Phpfox\Db\DbModel;

class Feed extends DbModel
{
    public function getModelId()
    {
        return 'feed';
    }

    public function getId()
    {
        return (int)$this->__get('feed_id');
    }

    public function setId($value)
    {
        $this->__set('feed_id', $value);
    }

    public function getTypeId()
    {
        return (int)$this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getAboutId()
    {
        return (int)$this->__get('about_id');
    }

    public function setAboutId($value)
    {
        $this->__set('about_id', $value);
    }

    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    public function setAboutType($value)
    {
        $this->__set('about_type', $value);
    }

    public function getPosterId()
    {
        return (int)$this->__get('poster_id');
    }

    public function setPosterId($value)
    {
        $this->__set('poster_id', $value);
    }

    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    public function setPosterType($value)
    {
        $this->__set('poster_type', $value);
    }

    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    public function setParentType($value)
    {
        $this->__set('parent_type', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

}