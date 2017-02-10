<?php

namespace Neutron\Blog\Model;


use Phpfox\Db\DbModel;

class Post extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'blog_post';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', $value);
    }

    /**
     * @return mixed|null
     */
    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value)
    {
        $this->__set('category_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value)
    {
        $this->__set('parent_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getPosterId()
    {
        return (int)$this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value)
    {
        $this->__set('poster_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value)
    {
        $this->__set('parent_type', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getPosterType()
    {
        return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value)
    {
        $this->__set('poster_type', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function isApproval()
    {
        return $this->__get('is_approval');
    }

    /**
     * @return mixed|null
     */
    public function getContent()
    {
        return $this->__get('content');
    }

    /**
     * @param $value
     */
    public function setContent($value)
    {
        $this->__set('content', (string)$value);
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
        $this->__set('title', (string)$value);
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
        $this->__set('description', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->__get('updated_at');
    }

    /**
     * @param $value
     */
    public function setUpdatedAt($value)
    {
        $this->__set('updated_at', (string)$value);
    }
}