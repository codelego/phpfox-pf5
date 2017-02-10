<?php
namespace Neutron\User\Model;

use Phpfox\Db\DbModel;
use Phpfox\Support\UserInterface;

class User extends DbModel implements UserInterface
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'user';
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return \Phpfox::get('router')
            ->getUrl('profile', ['name' => $this->getUsername()]);
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


    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('fullname');
    }

    /**
     * @return mixed|null
     */
    public function getEmail()
    {
        return $this->__get('email');
    }

    /**
     * @return mixed|null
     */
    public function getLocaleId()
    {
        return $this->__get('locale_id');
    }

    /**
     * @return mixed|null
     */
    public function getTimezone()
    {
        return $this->__get('timezone');
    }

    /**
     * @return mixed|null
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
        $this->__set('created_at', $value);
    }

    /**
     * @return mixed|null
     */
    public function getRoleId()
    {
        return (int)$this->__get('role_id');
    }

    /**
     * @return mixed|null
     */
    public function getGenderId()
    {
        return (int)$this->__get('gender_id');
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('user_id');
    }

    /**
     * @return mixed|null
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @return mixed|null
     */
    public function getFullname()
    {
        return $this->__get('fullname');
    }
}