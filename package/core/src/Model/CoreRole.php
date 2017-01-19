<?php
namespace Neutron\Core\Model;


use Phpfox\Db\DbModel;

class CoreRole extends DbModel
{
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
        return \Phpfox::getModel('user')
            ->select()
            ->where('role_id=?', $this->getId())
            ->count();
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        return (bool)$this->__get('is_guest');
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return (bool)$this->__get('is_banned');
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return (bool)$this->__get('is_registered');
    }

    /**
     * @return bool
     */
    public function isStaff()
    {
        return (bool)$this->__get('is_staff');
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        return (bool)$this->__get('is_moderator');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return (bool)$this->__get('is_admin');
    }

    /**
     * @return bool
     */
    public function isSuper()
    {
        return (bool)$this->__get('is_super');
    }

    /**
     * @return bool
     */
    public function isSpecial()
    {
        return (bool)$this->__get('is_special');
    }

}