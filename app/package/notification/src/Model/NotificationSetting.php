<?php

namespace Neutron\Notification\Model;

use Phpfox\Db\DbModel;

class NotificationSetting extends DbModel
{
    public function getModelId()
    {
        return 'notification_setting';
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }

}