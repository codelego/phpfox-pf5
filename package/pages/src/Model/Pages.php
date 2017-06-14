<?php

namespace Neutron\Pages\Model;

use Phpfox\Db\DbModel;

class Pages extends DbModel
{
    public function getModelId()
    {
        return 'pages';
    }

    public function getId()
    {
        return (int)$this->__get('page_id');
    }

    public function setId($value)
    {
        $this->__set('page_id', $value);
    }

    public function isFeatured()
    {
        return $this->__get('is_featured') ? 1 : 0;
    }

    public function setFeatured($value)
    {
        $this->__set('is_featured', $value ? 1 : 0);
    }

    public function isSponsor()
    {
        return $this->__get('is_sponsor') ? 1 : 0;
    }

    public function setSponsor($value)
    {
        $this->__set('is_sponsor', $value ? 1 : 0);
    }

    public function getTypeId()
    {
        return (int)$this->__get('type_id');
    }

    public function getLevelType()
    {
        return 'pages_level';
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    public function setCategoryId($value)
    {
        $this->__set('category_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getProfileName()
    {
        return (string)$this->__get('profile_name');
    }

    public function setProfileName($value)
    {
        $this->__set('profile_name', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getPhotoId()
    {
        return (int)$this->__get('photo_id');
    }

    public function setPhotoId($value)
    {
        $this->__set('photo_id', $value);
    }

    public function getCoverPhotoId()
    {
        return (int)$this->__get('cover_photo_id');
    }

    public function setCoverPhotoId($value)
    {
        $this->__set('cover_photo_id', $value);
    }

    public function getLikeCount()
    {
        return (int)$this->__get('like_count');
    }

    public function setLikeCount($value)
    {
        $this->__set('like_count', $value);
    }

    public function getCommentCount()
    {
        return (int)$this->__get('comment_count');
    }

    public function setCommentCount($value)
    {
        $this->__set('comment_count', $value);
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