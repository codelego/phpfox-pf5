<?php

namespace Neutron\Announcement\Model;

use Phpfox\Db\DbModel;

class Announcement extends DbModel
{
    public function getModelId()
    {
        return 'announcement';
    }

    public function getId()
    {
        return (int)$this->__get('announcement_id');
    }

    public function setId($value)
    {
        $this->__set('announcement_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
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

    public function getPhotoFileId()
    {
        return (int)$this->__get('photo_file_id');
    }

    public function setPhotoFileId($value)
    {
        $this->__set('photo_file_id', $value);
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

    public function getTypeId()
    {
        return (int)$this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getContent()
    {
        return $this->__get('content');
    }

    public function setContent($value)
    {
        $this->__set('content', $value);
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

    public function getPublishAt()
    {
        return $this->__get('publish_at');
    }

    public function setPublishAt($value)
    {
        $this->__set('publish_at', $value);
    }

    public function getExpiresAt()
    {
        return $this->__get('expires_at');
    }

    public function setExpiresAt($value)
    {
        $this->__set('expires_at', $value);
    }

}