<?php
namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class User extends DbModel
{

    public function getModelId()
    {
        return 'user';
    }

    public function getUsername()
    {
        return @$this->_data['username'];
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
        return @$this->_data['locale_id'];
    }

    public function getTimezone()
    {
        return @$this->_data['timezone'];
    }

    public function getCreated()
    {
        return @$this->_data['created'];
    }

    public function getRoleId()
    {
        return @$this->_data['role_id'];
    }

    public function getGenderId()
    {
        return @$this->_data['gender_id'];
    }

    public function getId()
    {
        return @$this->_data['user_id'];
    }

}