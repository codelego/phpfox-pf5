<?php

namespace Phpfox\Auth;


use Phpfox\Kernel\Event;
use Phpfox\Kernel\ItemInterface;
use Phpfox\Kernel\Parameters;
use Phpfox\Kernel\UserInterface;

class PermissionFacades
{
    /**
     * @var Parameters[]
     */
    private $data = [];

    /**
     * @var int
     */
    private $levelId = PHPFOX_GUEST_ID;

    /**
     * @var string
     */
    private $itemType = 'user';

    /**
     * @param string $levelKey
     * @param string $itemType
     * @param int    $levelId
     *
     * @return void
     */
    public function loadPermissionData($levelKey, $itemType, $levelId)
    {
        $this->data[$levelKey] = \Phpfox::get('permission.loader')
            ->getPermissionParameter($itemType, $levelId);
    }

    /**
     * @param UserInterface $user
     * @param string        $action
     * @param bool|mixed    $default
     *
     * @return mixed
     */
    public function allow($user, $action, $default = false)
    {
        $levelId = $this->levelId;
        $itemType = $this->itemType;

        if (null != $user) {
            $levelId = $user->getLevelId();
            $itemType = $user->getModelId();
        }

        if (!isset($this->data[$levelKey = $itemType . ':' . $levelId])) {
            $this->loadPermissionData($levelKey, $itemType, $levelId);
        }

        return $this->data[$levelKey]->get($action, $default);
    }

    /**
     * @param string $levelId
     * @param string $itemType
     * @param string $action
     * @param bool   $default
     *
     * @return bool
     */
    public function checkByLevel($levelId, $itemType, $action, $default = false)
    {
        if (!isset($this->data[$levelKey = $itemType . ':' . $levelId])) {
            $this->loadPermissionData($levelKey, $itemType, $levelId);
        }

        return $this->data[$levelKey]->get($action, $default);
    }

    /**
     * @param ItemInterface $parent
     * @param UserInterface $user
     * @param string        $relationType
     * @param string        $relationValue
     *
     * @return bool
     */
    public function checkRelationships($parent, $user, $relationType, $relationValue)
    {
        $map = $parent->getRelationships();
        // should use table :acl_relation to convert getRelationships so admin can control (enable, disable they).
        foreach ($map as $name) {
            if (!\Phpfox::has($name)) {
                continue;
            }
            $result = \Phpfox::_try('internal.cache',
                [$parent->getUniqueId(), $user->getUniqueId(), $name],
                0,
                function () use ($name, $parent, $user, $relationType) {
                    return \Phpfox::get($name)->getRelationships($parent, $user, $relationType);
                });

            if (in_array($relationValue, $result)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param UserInterface $user
     * @param ItemInterface $item
     * @param string        $action
     * @param string        $privacy
     *
     * @return bool
     */
    public function check($user, $item, $action, $privacy = null)
    {
        $levelId = $this->levelId;
        $itemType = $this->itemType;

        if (null != $user) {
            $levelId = $user->getLevelId();
            $itemType = $user->getModelId();
        }

        if (!isset($this->data[$levelKey = $itemType . ':' . $levelId])) {
            $this->loadPermissionData($levelKey, $itemType, $levelId);
        }

        $can = (bool)$this->data[$levelKey]->get($action, true);

        if (!$can) {
            return false;
        }

        if (!$privacy) {
            $privacy = $action;
        }

        // cache privacy of in process
        list($relationType, $relationValue) = $item->getPrivacy($privacy);

        if ($relationType == 'public') {
            return true;
        }

        if ($relationType == 'registered') {
            return true;
        }

        return $this->checkRelationships($item, $user, $relationType, $relationValue);
    }

    /**
     * @param UserInterface $user
     * @param ItemInterface $item
     * @param string        $action
     *
     * @return bool
     */
    public function pass($user, $item, $action)
    {
        /** todo implement this method */
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
            $this->levelId = $target->getLevelId();
            $this->itemType = $target->getModelId();
        } else {
            $this->levelId = PHPFOX_GUEST_ID;
            $this->itemType = 'user';
        }
    }
}