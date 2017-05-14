<?php

namespace Phpfox\Authorization;


use Phpfox\Event\Event;
use Phpfox\Support\UserInterface;

class AuthorizationManager
{
    /**
     * @var PermissionData[]
     */
    private $data = [];

    /**
     * @var int
     */
    private $roleId = PHPFOX_GUEST_ID;

    public function get($roleId)
    {
        return isset($this->data[$roleId]) ? $this->data[$roleId]
            : $this->data[$roleId] = $this->load($roleId);
    }

    /**
     * @param int            $roleId
     * @param PermissionData $data
     */
    public function set($roleId, $data)
    {
        $this->data[$roleId] = $data;
    }

    /**
     * @param int|null   $roleId
     * @param string     $action
     * @param bool|mixed $default
     *
     * @return mixed
     */
    public function pass($roleId, $action, $default = false)
    {
        if (null == $roleId) {
            $roleId = $this->roleId;
        }

        return (bool)$this->get($roleId)->get($action, $default);
    }

    /**
     * @param $roleId
     *
     * @return PermissionData
     * @throws \InvalidArgumentException
     */
    public function load($roleId)
    {
        return _get('authorization.provider')
            ->load($roleId);
    }

    /**
     * Handle event `onUserChanged`
     *
     * @param Event $event
     */
    public function onLoginUser(Event $event)
    {
        $target = $event->getTarget();
        if ($target instanceof UserInterface) {
            $this->roleId = $target->getRoleId();
        } else {
            $this->roleId = PHPFOX_GUEST_ID;
        }
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param int $value
     */
    public function setRoleId($value)
    {
        $this->roleId = (int)$value;
    }
}