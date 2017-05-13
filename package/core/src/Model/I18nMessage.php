<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class I18nMessage extends DbModel
{
    public function getModelId()
    {
        return 'i18n_message';
    }

    public function getMessageId()
    {
        return (int)$this->__get('message_id');
    }

    public function getId()
    {
        return (int)$this->__get('message_id');
    }

    public function setMessageId($value)
    {
        $this->__set('message_id', $value);
    }

    public function setId($value)
    {
        $this->__set('message_id', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getLocaleId()
    {
        return $this->__get('locale_id');
    }

    public function setLocaleId($value)
    {
        $this->__set('locale_id', $value);
    }

    public function getDomainId()
    {
        return $this->__get('domain_id');
    }

    public function setDomainId($value)
    {
        $this->__set('domain_id', $value);
    }

    public function getMessageName()
    {
        return $this->__get('message_name');
    }

    public function setMessageName($value)
    {
        $this->__set('message_name', $value);
    }

    public function getMessageValue()
    {
        return $this->__get('message_value');
    }

    public function setMessageValue($value)
    {
        $this->__set('message_value', $value);
    }

    public function isJson()
    {
        return $this->__get('is_json') ? 1 : 0;
    }

    public function setJson($value)
    {
        $this->__set('is_json', $value ? 1 : 0);
    }

    public function isUpdated()
    {
        return $this->__get('is_updated') ? 1 : 0;
    }

    public function setUpdated($value)
    {
        $this->__set('is_updated', $value ? 1 : 0);
    }
}