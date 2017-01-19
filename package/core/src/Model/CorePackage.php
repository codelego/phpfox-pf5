<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CorePackage extends DbModel
{
    public function getModelId()
    {
        return 'core_package';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    public function isCore()
    {
        return (bool)$this->__get('is_core');
    }

    public function isTheme()
    {
        return (bool)$this->__get('is_theme');
    }

    public function isLanguage()
    {
        return (bool)$this->__get('is_language');
    }

    public function isApp()
    {
        return (bool)$this->__get('is_app');
    }

    public function isLibrary()
    {
        return (bool)$this->__get('is_library');
    }

    public function getThemeId()
    {
        return $this->__get('theme_id');
    }

    public function getVersion()
    {
        return $this->__get('version');
    }

    public function getAuthor()
    {
        return $this->__get('author');
    }

    public function getDescription()
    {
        return $this->__get('description');
    }
}