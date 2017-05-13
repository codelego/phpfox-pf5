<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class Session extends DbModel
{
    public function getModelId()
    {
        return 'session';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getModified()
    {
        return (int)$this->__get('modified');
    }

    public function setModified($value)
    {
        $this->__set('modified', $value);
    }

    public function getLifetime()
    {
        return (int)$this->__get('lifetime');
    }

    public function setLifetime($value)
    {
        $this->__set('lifetime', $value);
    }

    public function getData()
    {
        return $this->__get('data');
    }

    public function setData($value)
    {
        $this->__set('data', $value);
    }
}