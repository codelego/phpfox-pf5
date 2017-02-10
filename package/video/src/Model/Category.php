<?php
namespace Neutron\Video\Model;

use Phpfox\Db\DbModel;

class Category extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'video_category';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return int
     */
    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    /**
     * @param mixed $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    /**
     * @param $value
     */
    public function setDescription($value)
    {
        $this->__set('description', (string)$value);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', $value);
    }
}