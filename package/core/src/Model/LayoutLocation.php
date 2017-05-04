<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutLocation extends DbModel
{
    public function getModelId()
    {
        return 'layout_location';
    }

    public function getContainerId()
    {
        return (int)$this->__get('container_id');
    }

    public function setContainerId($value)
    {
        $this->__set('container_id', $value);
    }

    public function getLocationId()
    {
        return $this->__get('location_id');
    }

    public function setLocationId($value)
    {
        $this->__set('location_id', $value);
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