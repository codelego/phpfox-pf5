<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class MailTemplate extends DbModel
{
    public function getModelId()
    {
        return 'mail_template';
    }

    public function getId()
    {
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getLanguageId()
    {
        return $this->__get('language_id');
    }

    public function setLanguageId($value)
    {
        $this->__set('language_id', $value);
    }

    public function getCode()
    {
        return $this->__get('code');
    }

    public function setCode($value)
    {
        $this->__set('code', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getVars()
    {
        return $this->__get('vars');
    }

    public function setVars($value)
    {
        $this->__set('vars', $value);
    }

}