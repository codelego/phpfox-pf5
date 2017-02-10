<?php

namespace Neutron\Report\Model;

use Phpfox\Db\DbModel;

class Category extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'report_category';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('category_id');
    }

    /**
     * @return mixed
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
        return _text($this->__get('name'), 'report');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    /**
     * @param bool|int $value
     */
    public function setActive($value)
    {
        $this->__set('active', $value ? 1 : 0);
    }

    /**
     * @param string $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->__set('name', (string)$value);
    }
}