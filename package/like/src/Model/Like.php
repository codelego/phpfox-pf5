<?php

namespace Neutron\Like\Model;

use Phpfox\Db\DbModel;

class Like extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'like';
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
        $this->__set('id', (int)$value);
    }

    /**
     * @return int
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
     * @return int
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
     * @return int
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
    public function getAboutId()
    {
        return (int)$this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value)
    {
        $this->__set('about_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value)
    {
        $this->__set('about_type', (string)$value);
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
}