<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CoreTheme extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'core_theme';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return _text($this->__get('var_name'));
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->__get('is_default');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return bool
     */
    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @return mixed|null
     */
    public function getAuthor()
    {
        return $this->__get('author');
    }

    /**
     * @return mixed|null
     */
    public function getVersion()
    {
        return $this->__get('version');
    }
}