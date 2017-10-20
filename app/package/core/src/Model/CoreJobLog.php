<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreJobLog extends DbModel
{
    public function getModelId()
    {
        return 'core_job_log';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getIp()
    {
        return $this->__get('ip');
    }

    public function setIp($value)
    {
        $this->__set('ip', $value);
    }

    public function getUpdated()
    {
        return $this->__get('updated');
    }

    public function setUpdated($value)
    {
        $this->__set('updated', $value);
    }

    public function getLevel()
    {
        return $this->__get('level');
    }

    public function setLevel($value)
    {
        $this->__set('level', $value);
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