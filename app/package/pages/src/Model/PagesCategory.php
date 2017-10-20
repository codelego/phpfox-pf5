<?php

namespace Neutron\Pages\Model;

use Phpfox\Db\DbModel;

class PagesCategory extends DbModel
{
    public function getModelId()
    {
        return 'pages_category';
    }

    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    public function getId()
    {
        return (int)$this->__get('category_id');
    }

    public function setCategoryId($value)
    {
        $this->__set('category_id', $value);
    }

    public function setId($value)
    {
        $this->__set('category_id', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }
}