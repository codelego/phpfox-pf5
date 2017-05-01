<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutContainer extends DbModel
{
    public function getModelId()
    {
        return 'layout_container';
    }

    public function getId()
    {
        return (int)$this->__get('container_id');
    }

    public function setId($value)
    {
        $this->__set('container_id', $value);
    }

    public function getLayoutId()
    {
        return (int)$this->__get('layout_id');
    }

    public function setLayoutId($value)
    {
        $this->__set('layout_id', $value);
    }

    public function getGridId()
    {
        return $this->__get('grid_id');
    }

    public function setGridId($value)
    {
        $this->__set('grid_id', $value);
    }

    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getSortOrder()
    {
        return (int)$this->__get('sort_order');
    }

    public function setSortOrder($value)
    {
        $this->__set('sort_order', $value);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return json_decode($this->__get('container_params'), true);
    }

    public function getContainerParams()
    {
        return $this->__get('container_params');
    }

    public function setContainerParams($value)
    {
        $this->__set('container_params', $value);
    }

}