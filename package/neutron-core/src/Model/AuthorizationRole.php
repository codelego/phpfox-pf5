<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class AuthorizationRole extends DbModel
{
    public function getModelId()
    {
        return 'authorization_role';
    }

    public function getId()
    {
        return $this->__get('role_id');
    }

    public function getName()
    {
        return _text($this->__get('title'));
    }

    public function getTitle()
    {
        return _text($this->__get('title'));
    }

    public function getInheritId()
    {
        return $this->__get('inherit_id');
    }
}