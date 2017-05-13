<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreEvent extends DbModel
{
    public function getModelId()
    {
        return 'core_event';
    }

    public function getId()
    {
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getEventName()
    {
        return $this->__get('event_name');
    }

    public function setEventName($value)
    {
        $this->__set('event_name', $value);
    }

    public function getListenerName()
    {
        return $this->__get('listener_name');
    }

    public function setListenerName($value)
    {
        $this->__set('listener_name', $value);
    }

    public function getPriority()
    {
        return (int)$this->__get('priority');
    }

    public function setPriority($value)
    {
        $this->__set('priority', $value);
    }
}