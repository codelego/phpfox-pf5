<?php

namespace Neutron\User\Model;

use Phpfox\Db\DbModel;
use Phpfox\Support\UserInterface;

class User extends DbModel implements UserInterface
{
    public function getUniqueId()
    {
        return 'user_' . $this->getId();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return _url('profile', ['name' => $this->getUsername()]);
    }

    /**
     * @return mixed|null
     */
    public function getUsername()
    {
        return $this->__get('username');
    }

    /**
     * @return mixed|null
     */
    public function getProfileName()
    {
        return $this->__get('username');
    }

    /**
     * @return bool
     */
    public function isUser()
    {
        return true;
    }

    public function getOwner()
    {
        return $this;
    }

    public function getPoster()
    {
        return $this;
    }

    public function getParent()
    {
        return $this;
    }

    public function getRelationships()
    {
        return ['friend.friendship'];
    }

    public function getPrivacy($action)
    {
        // TODO: Implement getPrivacy() method.
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('fullname');
    }

    public function getModelId()
    {
        return 'user';
    }

    public function getId()
    {
        return (int)$this->__get('user_id');
    }

    public function setId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getLevelId()
    {
        return (int)$this->__get('level_id');
    }

    public function setLevelId($value)
    {
        $this->__set('level_id', $value);
    }

    public function getUserPhotoId()
    {
        return (int)$this->__get('user_photo_id');
    }

    public function setUserPhotoId($value)
    {
        $this->__set('user_photo_id', $value);
    }

    public function getGenderId()
    {
        return (int)$this->__get('gender_id');
    }

    public function setGenderId($value)
    {
        $this->__set('gender_id', $value);
    }

    public function getStatusId()
    {
        return (int)$this->__get('status_id');
    }

    public function setStatusId($value)
    {
        $this->__set('status_id', $value);
    }

    public function getViewId()
    {
        return (int)$this->__get('view_id');
    }

    public function setViewId($value)
    {
        $this->__set('view_id', $value);
    }

    public function setUsername($value)
    {
        $this->__set('username', $value);
    }

    public function getFullname()
    {
        return $this->__get('fullname');
    }

    public function setFullname($value)
    {
        $this->__set('fullname', $value);
    }

    public function getEmail()
    {
        return $this->__get('email');
    }

    public function setEmail($value)
    {
        $this->__set('email', $value);
    }

    public function getLocaleId()
    {
        return $this->__get('locale_id');
    }

    public function setLocaleId($value)
    {
        $this->__set('locale_id', $value);
    }

    public function getTimezone()
    {
        return $this->__get('timezone');
    }

    public function setTimezone($value)
    {
        $this->__set('timezone', $value);
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