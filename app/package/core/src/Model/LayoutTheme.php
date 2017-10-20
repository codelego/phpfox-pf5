<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutTheme extends DbModel
{
    public function getModelId()
    {
        return 'layout_theme';
    }

    public function getThemeId()
    {
        return $this->__get('theme_id');
    }

    public function getId()
    {
        return $this->__get('theme_id');
    }

    public function setThemeId($value)
    {
        $this->__set('theme_id', $value);
    }

    public function setId($value)
    {
        $this->__set('theme_id', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function isDefault()
    {
        return $this->__get('is_default') ? 1 : 0;
    }

    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function isEditing()
    {
        return $this->__get('is_editing') ? 1 : 0;
    }

    public function setEditing($value)
    {
        $this->__set('is_editing', $value ? 1 : 0);
    }

    public function isAdmin()
    {
        return $this->__get('is_admin') ? 1 : 0;
    }

    public function setAdmin($value)
    {
        $this->__set('is_admin', $value ? 1 : 0);
    }
}