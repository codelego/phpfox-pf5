<?php

namespace Neutron\Blog\Model;


use Phpfox\Db\DbModel;

class Post extends DbModel
{
    public function getModelId()
    {
        return 'blog_post';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function getCategoryId()
    {
        return $this->__get('category_id');
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function getUserId()
    {
        return $this->__get('user_id');
    }

    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    public function getPosterId()
    {
        return $this->__get('poster_id');
    }

    public function getParentType()
    {
        return $this->__get('parent_type');

    }

    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    public function isApproval()
    {
        return $this->__get('is_approval');
    }

    public function getContent()
    {
        return $this->__get('content');
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function getUpdatedAt()
    {
        return $this->__get('updated_at');
    }
}