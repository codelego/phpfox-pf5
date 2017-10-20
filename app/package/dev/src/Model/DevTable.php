<?php

namespace Neutron\Dev\Model;

use Phpfox\Db\DbModel;

class DevTable extends DbModel
{
    public function getModelId()
    {
        return 'dev_table';
    }

    public function getId()
    {
        return $this->__get('table_name');
    }

    public function setId($value)
    {
        $this->__set('table_name', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getActionId()
    {
        return $this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

}