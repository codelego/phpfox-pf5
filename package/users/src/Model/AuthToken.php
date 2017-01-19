<?php
namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthToken extends DbModel
{
    public function getModelId()
    {
        return 'auth_token';
    }

    public function getUserId()
    {
        return $this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }
}