<?php

namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class AuthHistory extends DbModel
{
    public function getModelId()
    {
        return 'user_auth_history';
    }

    public function getDeviceName()
    {
        return $this->__get('device_name');
    }

    public function getRemoteAddress()
    {
        return $this->__get('remote_address');
    }

    public function getCreated()
    {
        return $this->__get('created');
    }
}