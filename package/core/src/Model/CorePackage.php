<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CorePackage extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'core_package';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->__get('is_active');
    }

    /**
     * @return bool
     */
    public function isCore()
    {
        return (bool)$this->__get('is_core');
    }

    /**
     * @return bool
     */
    public function isTheme()
    {
        return (bool)$this->__get('is_theme');
    }

    /**
     * @return bool
     */
    public function isLanguage()
    {
        return (bool)$this->__get('is_language');
    }

    /**
     * @return bool
     */
    public function isApp()
    {
        return (bool)$this->__get('is_app');
    }

    /**
     * @return bool
     */
    public function isLibrary()
    {
        return (bool)$this->__get('is_library');
    }

    /**
     * @return mixed|null
     */
    public function getThemeId()
    {
        return $this->__get('theme_id');
    }

    /**
     * @return mixed|null
     */
    public function getVersion()
    {
        return $this->__get('version');
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
    public function getDescription()
    {
        return $this->__get('description');
    }

    /**
     * @return mixed|null
     */
    public function getPackageType()
    {
        return $this->__get('package_type');
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->__get('name');
    }

    /**
     * @return mixed|null
     */
    public function getPath()
    {
        return $this->__get('path');
    }

    /**
     * @return mixed|null
     */
    public function getIcon()
    {
        return $this->__get('apps_icon');
    }

    /**
     * @return mixed|null
     */
    public function getPriority()
    {
        return $this->__get('priority');
    }
}