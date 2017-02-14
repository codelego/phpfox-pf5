<?php

namespace Neutron\Group\Model;

use Phpfox\Db\DbModel;

class Group extends DbModel
{
    public function getModelId()
    {
        return 'group';
    }

    public function getId()
    {
        return (int)$this->__get('group_id');
    }

    public function setId($value)
    {
        $this->__set('group_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function isSponsor()
    {
        return $this->__get('is_sponsor') ? 1 : 0;
    }

    public function setSponsor($value)
    {
        $this->__set('is_sponsor', $value ? 1 : 0);
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
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

    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    public function setCategoryId($value)
    {
        $this->__set('category_id', $value);
    }

    public function getLocationId()
    {
        return (int)$this->__get('location_id');
    }

    public function setLocationId($value)
    {
        $this->__set('location_id', $value);
    }

    public function getInviteId()
    {
        return (int)$this->__get('invite_id');
    }

    public function setInviteId($value)
    {
        $this->__set('invite_id', $value);
    }

    public function isApproval()
    {
        return $this->__get('is_approval') ? 1 : 0;
    }

    public function setApproval($value)
    {
        $this->__set('is_approval', $value ? 1 : 0);
    }

    public function isFeatured()
    {
        return $this->__get('is_featured') ? 1 : 0;
    }

    public function setFeatured($value)
    {
        $this->__set('is_featured', $value ? 1 : 0);
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

    public function getPhotoId()
    {
        return (int)$this->__get('photo_id');
    }

    public function setPhotoId($value)
    {
        $this->__set('photo_id', $value);
    }

    public function getCoverId()
    {
        return (int)$this->__get('cover_id');
    }

    public function setCoverId($value)
    {
        $this->__set('cover_id', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    public function getUpdatedAt()
    {
        return $this->__get('updated_at');
    }

    public function setUpdatedAt($value)
    {
        $this->__set('updated_at', $value);
    }

    public function getMemberCount()
    {
        return (int)$this->__get('member_count');
    }

    public function setMemberCount($value)
    {
        $this->__set('member_count', $value);
    }

    public function getViewCount()
    {
        return (int)$this->__get('view_count');
    }

    public function setViewCount($value)
    {
        $this->__set('view_count', $value);
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

}