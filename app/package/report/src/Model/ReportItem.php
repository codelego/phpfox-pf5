<?php

namespace Neutron\Report\Model;

use Phpfox\Db\DbModel;

class ReportItem extends DbModel
{
    public function getModelId()
    {
        return 'report_item';
    }

    public function getId()
    {
        return (int)$this->__get('item_id');
    }

    public function setId($value)
    {
        $this->__set('item_id', $value);
    }

    public function getCategoryId()
    {
        return (int)$this->__get('category_id');
    }

    public function setCategoryId($value)
    {
        $this->__set('category_id', $value);
    }

    public function getMessage()
    {
        return $this->__get('message');
    }

    public function setMessage($value)
    {
        $this->__set('message', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getAboutId()
    {
        return (int)$this->__get('about_id');
    }

    public function setAboutId($value)
    {
        $this->__set('about_id', $value);
    }

    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    public function setAboutType($value)
    {
        $this->__set('about_type', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

}