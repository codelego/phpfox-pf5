<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class I18nLanguage extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'i18n_language';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getNativeName()
    {
        return $this->__get('native_name');
    }

    /**
     * @param $value
     */
    public function setNativeName($value)
    {
        $this->__set('native_name', (string)$value);
    }

    /**
     * @param $value
     */
    public function setDefault($value)
    {
        return $this->__set('is_default', $value ? 1 : 0);
    }

    /**
     * @return mixed|null
     */
    public function isDefault()
    {
        return $this->__get('is_default');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        return $this->__set('is_active', $value ? 1 : 0);
    }

    /**
     * @return mixed|null
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return mixed|null
     */
    public function getDirection()
    {
        return $this->__get('direction');
    }

    /**
     * @param $value
     */
    public function setDirection($value)
    {
        return $this->__set('direction', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getCode6391()
    {
        return $this->__get('code_6391');
    }

    /**
     * @param $value
     */
    public function setCode6391($value)
    {
        return $this->__set('code_6391', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }
}