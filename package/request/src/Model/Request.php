<?php

namespace Neutron\Request\Model;

use Phpfox\Db\DbModel;

class Request extends DbModel
{
    public function getModelId()
    {
        return 'request';
    }

    public function getId()
    {
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
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

    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    public function setAboutType($value)
    {
        $this->__set('about_type', $value);
    }

    public function getAboutId()
    {
        return (int)$this->__get('about_id');
    }

    public function setAboutId($value)
    {
        $this->__set('about_id', $value);
    }

    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }

    public function isRead()
    {
        return $this->__get('is_read') ? 1 : 0;
    }

    public function setRead($value)
    {
        $this->__set('is_read', $value ? 1 : 0);
    }

    public function isMitigated()
    {
        return $this->__get('is_mitigated') ? 1 : 0;
    }

    public function setMitigated($value)
    {
        $this->__set('is_mitigated', $value ? 1 : 0);
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