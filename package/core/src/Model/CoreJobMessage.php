<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreJobMessage extends DbModel
{
    public function getModelId()
    {
        return 'core_job_message';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getQueue()
    {
        return $this->__get('queue');
    }

    public function setQueue($value)
    {
        $this->__set('queue', $value);
    }

    public function getData()
    {
        return $this->__get('data');
    }

    public function setData($value)
    {
        $this->__set('data', $value);
    }

    public function getExpiration()
    {
        return $this->__get('expiration');
    }

    public function setExpiration($value)
    {
        $this->__set('expiration', $value);
    }

    public function getStatusId()
    {
        return $this->__get('status_id');
    }

    public function setStatusId($value)
    {
        $this->__set('status_id', $value);
    }

    public function getDeliveredAt()
    {
        return $this->__get('delivered_at');
    }

    public function setDeliveredAt($value)
    {
        $this->__set('delivered_at', $value);
    }
}