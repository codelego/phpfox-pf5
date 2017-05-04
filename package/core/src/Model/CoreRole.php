<?php

namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CoreRole extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'core_role';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->__get('role_id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return _text($this->__get('title'));
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return _text($this->__get('title'));
    }

    /**
     * @return mixed
     */
    public function getInheritId()
    {
        return $this->__get('inherit_id');
    }

    /**
     * @return int
     */
    public function getUserCount()
    {
        return \Phpfox::with('user')
            ->select()
            ->where('role_id=?', $this->getId())
            ->count();
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        return $this->__get('is_guest') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->__get('is_banned') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return $this->__get('is_registered') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isStaff()
    {
        return $this->__get('is_staff') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        return $this->__get('is_moderator') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->__get('is_admin') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isSuper()
    {
        return $this->__get('is_super') ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isSpecial()
    {
        return $this->__get('is_special') ? 1 : 0;
    }

    /**
     * @return mixed|null
     */
    public function getRoleId()
    {
        return $this->__get('role_id');
    }

}