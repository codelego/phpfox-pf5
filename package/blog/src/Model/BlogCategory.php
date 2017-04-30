<?php

namespace Neutron\Blog\Model;

use Phpfox\Db\DbModel;

class BlogCategory extends DbModel
{
    public function getModelId()
    {
        return 'blog_category';
    }

    public function getId()
    {
        return (int)$this->__get('category_id');
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

    public function getUrl()
    {
        return _url('blogs',[],['category'=>$this->getId()]);
    }

    public function getTitle()
    {
        return $this->__get('name');
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