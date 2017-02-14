<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nMessage extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'i18n_message';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return mixed|null
     */
    public function getLocale()
    {
        return $this->__get('locale');
    }

    /**
     * @param $value
     */
    public function setLocale($value)
    {
        $this->__set('locale', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getDomain()
    {
        return $this->__get('domain');
    }

    /**
     * @param $value
     */
    public function setDomain($value)
    {
        $this->__set('domain', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('var_name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('var_name', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getTextValue()
    {
        return $this->__get('text_value');
    }

    /**
     * @param $value
     */
    public function setTextValue($value)
    {
        $this->__set('text_value', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function isJson()
    {
        return $this->__get('is_json');
    }

    /**
     * @return mixed|null
     */
    public function isUpdated()
    {
        return $this->__get('is_updated');
    }

    /**
     * @param $value
     */
    public function setJson($value)
    {
        $this->__set('is_json', $value ? 1 : 0);
    }

    /**
     * @param $value
     */
    public function setUpdated($value)
    {
        $this->__set('is_updated', $value ? 1 : 0);
    }
}