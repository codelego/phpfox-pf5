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
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function isRequired()
    {
        return $this->__get('is_required') ? 1 : 0;
    }

    public function setRequired($value)
    {
        $this->__set('is_required', $value ? 1 : 0);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getThemeId()
    {
        return $this->__get('theme_id');
    }

    public function setThemeId($value)
    {
        $this->__set('theme_id', $value);
    }

    public function getPriority()
    {
        return (int)$this->__get('priority');
    }

    public function setPriority($value)
    {
        $this->__set('priority', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    public function getVersion()
    {
        return $this->__get('version');
    }

    public function setVersion($value)
    {
        $this->__set('version', $value);
    }

    public function getLatestVersion()
    {
        return $this->__get('latest_version');
    }

    public function setLatestVersion($value)
    {
        $this->__set('latest_version', $value);
    }

    public function getAuthor()
    {
        return $this->__get('author');
    }

    public function setAuthor($value)
    {
        $this->__set('author', $value);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }

    public function getAppsIcon()
    {
        return $this->__get('apps_icon');
    }

    public function setAppsIcon($value)
    {
        $this->__set('apps_icon', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getPath()
    {
        return $this->__get('path');
    }

    public function setPath($value)
    {
        $this->__set('path', $value);
    }

    /**
     * @return bool
     */
    public function canEnable()
    {
        return !$this->isRequired() and !$this->isActive();
    }

    /**
     * @return bool
     */
    public function canDisable()
    {
        return !$this->isRequired() and $this->isActive();
    }

    /**
     * @return bool
     */
    public function canUninstall()
    {
        return !$this->isRequired();
    }

    /**
     * @return bool
     */
    public function canUpgrade()
    {
        return $this->getLatestVersion()
            and version_compare($this->getVersion(),
                $this->getLatestVersion()) > 0;
    }

    /**
     * @return bool
     */
    public function canExport()
    {
        return true;
    }
}