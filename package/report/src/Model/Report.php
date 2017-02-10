<?php

namespace Neutron\Report\Model;

use Phpfox\Db\DbModel;

class Report extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'report';
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->__get('report_id');
    }

    /**
     * @return string
     */
    public function getReportId()
    {
        return $this->__get('report_id');
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->__get('message');
    }

    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->__get('category_id');
    }

    /**
     * @return string
     */
    public function getAboutId()
    {
        return $this->__get('about_id');
    }

    /**
     * @return string
     */
    public function getAboutType()
    {
        return $this->__get('about_type');
    }

    /**
     * @return string
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
     * @param $value
     */
    public function setCategoryId($value)
    {
        $this->__set('category_id', intval($value));
    }

    /**
     * @param string $value
     */
    public function setMessage($value)
    {
        $this->__set('message', (string)$value);
    }

    /**
     * @param string $value
     */
    public function setAboutId($value)
    {
        $this->__set('about_id', intval($value));
    }

    /**
     * @param string $value
     */
    public function setAboutType($value)
    {
        $this->__set('about_type', (string)$value);
    }

    /**
     * @param string $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', intval($value));
    }
}