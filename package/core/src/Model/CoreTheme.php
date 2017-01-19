<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CoreTheme extends DbModel
{
    public function getModelId()
    {
        return 'core_theme';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function getName()
    {
        return _text($this->__get('var_name'));
    }

    public function isDefault()
    {
        return (bool)$this->__get('is_default');
    }

    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    public function getParentId()
    {
        return (bool)$this->__get('parent_id');
    }

}