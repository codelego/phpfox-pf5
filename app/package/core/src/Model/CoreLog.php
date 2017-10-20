<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreLog extends DbModel
{
    public function getModelId()
    {
        return 'core_log';
    }

    public function getId()
    {
        return (int)$this->__get('id');
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

    public function getCreated()
    {
        return $this->__get('created');
    }

    public function setCreated($value)
    {
        $this->__set('created', $value);
    }
}