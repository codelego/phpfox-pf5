<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutGrid extends DbModel
{
    public function getModelId()
    {
        return 'layout_grid';
    }

    public function getGridId()
    {
        return $this->__get('grid_id');
    }

    public function getId()
    {
        return $this->__get('grid_id');
    }

    public function setGridId($value)
    {
        $this->__set('grid_id', $value);
    }

    public function setId($value)
    {
        $this->__set('grid_id', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    public function getLocations()
    {
        return $this->__get('locations');
    }

    public function setLocations($value)
    {
        $this->__set('locations', $value);
    }
}