<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class Theme extends DbModel
{
    public function getModelId()
    {
        return 'theme';
    }

    public function getId()
    {
        return $this->__get('theme_id');
    }

    public function setId($value)
    {
        $this->__set('theme_id', $value);
    }

    public function getVarName()
    {
        return $this->__get('var_name');
    }

    public function getName()
    {
        return _text($this->getVarName());
    }

    public function setVarName($value)
    {
        $this->__set('var_name', $value);
    }

    public function getParentId()
    {
        return (string)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', (string)$value);
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

    public function getAuthor()
    {
        return $this->__get('author');
    }

    public function setAuthor($value)
    {
        $this->__set('author', $value);
    }

    public function getVersion()
    {
        return $this->__get('version');
    }

    public function setVersion($value)
    {
        $this->__set('version', $value);
    }

}