<?php
namespace Neutron\User\Model;

use Phpfox\Db\DbModel;
use Phpfox\Support\UserInterface;

class User extends DbModel implements UserInterface
{
    public function getUrl()
    {
        return \Phpfox::get('router')
            ->getUrl('profile', ['name' => $this->getUsername()]);
    }

    public function getUsername()
    {
        return @$this->_data['username'];
    }

    public function getProfileName()
    {
        return $this->__get('username');
    }

    public function isUser()
    {
        return true;
    }

    public function getModelId()
    {
        return 'user';
    }

    public function getName()
    {
        return @$this->_data['fullname'];
    }

    public function getEmail()
    {
        return @$this->_data['email'];
    }

    public function getLocaleId()
    {
        return $this->__get('locale_id');
    }

    public function getTimezone()
    {
        return $this->__get('timezone');
    }

    public function getCreated()
    {
        return $this->__get('created');
    }

    public function getRoleId()
    {
        return $this->__get('role_id');
    }

    public function getGenderId()
    {
        return $this->__get('gender_id');
    }

    public function getId()
    {
        return $this->__get('user_id');
    }

}