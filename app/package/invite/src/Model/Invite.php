<?php

namespace Neutron\Invite\Model;

use Phpfox\Db\DbModel;

class Invite extends DbModel
{
    public function getModelId()
    {
        return 'invite';
    }

    public function getId()
    {
        return $this->__get('id');
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

    public function getRecipient()
    {
        return $this->__get('recipient');
    }

    public function setRecipient($value)
    {
        $this->__set('recipient', $value);
    }

    public function getNewUserId()
    {
        return (int)$this->__get('new_user_id');
    }

    public function setNewUserId($value)
    {
        $this->__set('new_user_id', $value);
    }

    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    public function getExpiresAt()
    {
        return $this->__get('expires_at');
    }

    public function setExpiresAt($value)
    {
        $this->__set('expires_at', $value);
    }

    public function getMessage()
    {
        return $this->__get('message');
    }

    public function setMessage($value)
    {
        $this->__set('message', $value);
    }

}