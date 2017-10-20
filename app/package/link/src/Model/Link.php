<?php

namespace Neutron\Link\Model;

use Phpfox\Db\DbModel;

class Link extends DbModel
{
    public function getModelId()
    {
        return 'link';
    }

    public function getId()
    {
        return (int)$this->__get('link_id');
    }

    public function setId($value)
    {
        $this->__set('link_id', $value);
    }

    public function getUrl()
    {
        return $this->__get('url');
    }

    public function setUrl($value)
    {
        $this->__set('url', $value);
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

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getPhotoFileId()
    {
        return (int)$this->__get('photo_file_id');
    }

    public function setPhotoFileId($value)
    {
        $this->__set('photo_file_id', $value);
    }

    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    public function setParentType($value)
    {
        $this->__set('parent_type', $value);
    }

    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    public function setPosterType($value)
    {
        $this->__set('poster_type', $value);
    }

    public function getPosterId()
    {
        return (int)$this->__get('poster_id');
    }

    public function setPosterId($value)
    {
        $this->__set('poster_id', $value);
    }

    public function getViewCount()
    {
        return (int)$this->__get('view_count');
    }

    public function setViewCount($value)
    {
        $this->__set('view_count', $value);
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

    public function getPrivacyId()
    {
        return (int)$this->__get('privacy_id');
    }

    public function setPrivacyId($value)
    {
        $this->__set('privacy_id', $value);
    }

}