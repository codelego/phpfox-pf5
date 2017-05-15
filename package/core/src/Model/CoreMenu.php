<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreMenu extends DbModel
{
    public function getModelId()
    {
        return 'core_menu';
    }

    public function getId()
    {
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
    }

    public function getMenu()
    {
        return $this->__get('menu');
    }

    public function setMenu($value)
    {
        $this->__set('menu', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getParentName()
    {
        return $this->__get('parent_name');
    }

    public function setParentName($value)
    {
        $this->__set('parent_name', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getLabel()
    {
        return $this->__get('label');
    }

    public function setLabel($value)
    {
        $this->__set('label', $value);
    }

    public function getRoute()
    {
        return $this->__get('route');
    }

    public function setRoute($value)
    {
        $this->__set('route', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }

    public function getExtra()
    {
        return $this->__get('extra');
    }

    public function setExtra($value)
    {
        $this->__set('extra', $value);
    }

    public function getAcl()
    {
        return $this->__get('acl');
    }

    public function setAcl($value)
    {
        $this->__set('acl', $value);
    }

    public function getEvent()
    {
        return $this->__get('event');
    }

    public function setEvent($value)
    {
        $this->__set('event', $value);
    }

    public function getPlugin()
    {
        return $this->__get('plugin');
    }

    public function setPlugin($value)
    {
        $this->__set('plugin', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function isCustom()
    {
        return $this->__get('is_custom') ? 1 : 0;
    }

    public function setCustom($value)
    {
        $this->__set('is_custom', $value ? 1 : 0);
    }

    public function getType()
    {
        return $this->__get('type');
    }

    public function setType($value)
    {
        $this->__set('type', $value);
    }
}