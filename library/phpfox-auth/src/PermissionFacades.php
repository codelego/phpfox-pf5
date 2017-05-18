<?php

namespace Phpfox\Auth;


use Phpfox\Support\Event;
use Phpfox\Support\Parameters;
use Phpfox\Support\UserInterface;

class PermissionFacades
{
    /**
     * @var Parameters[]
     */
    private $data = [];

    /**
     * @var int
     */
    private $roleId = PHPFOX_GUEST_ID;

    /**
     * @param $roleId
     *
     * @return Parameters
     */
    public function get($roleId)
    {
        return isset($this->data[$roleId]) ? $this->data[$roleId]
            : $this->data[$roleId] = _get('package.loader')->getPermissionParameter($roleId);
    }

    /**
     * @param int        $roleId
     * @param Parameters $data
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

        if (!isset($this->data[$roleId])) {
            $this->data[$roleId] = _get('package.loader')->_getPermissionParameter($roleId);
        }

        return (bool)$this->data[$roleId]->get($action, $default);
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