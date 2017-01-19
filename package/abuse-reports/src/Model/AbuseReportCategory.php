<?php

namespace Neutron\AbuseReport\Model;


use Phpfox\Db\DbModel;

class AbuseReportCategory extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'abuse_report_category';
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
        return _text($this->__get('name'), 'abuse report');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }


}