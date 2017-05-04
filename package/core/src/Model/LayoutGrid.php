<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutGrid extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'layout_grid';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('grid_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('grid_id', $value);
    }

    /**
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return (int)$this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value)
    {
        $this->__set('sort_order', $value);
    }

    /**
     * @return mixed|null
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    /**
     * @return mixed|null
     */
    public function getLocations()
    {
        return $this->__get('locations');
    }

    /**
     * @param $value
     */
    public function setLocations($value)
    {
        $this->__set('locations', $value);
    }
}