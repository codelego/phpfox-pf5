<?php

namespace Phpfox\Auth;


use Phpfox\Support\Event;
use Phpfox\Support\ItemInterface;
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
    private $levelId = PHPFOX_GUEST_ID;

    /**
     * @var string
     */
    private $levelType = 'user';

    /**
     * @param string $levelKey
     * @param string $levelType
     * @param int    $levelId
     *
     * @return void
     */
    public function loadPermissionData($levelKey, $levelType, $levelId)
    {
        $this->data[$levelKey] = _get('package.loader')
            ->getPermissionParameter($levelType, $levelId);
    }

    /**
     * @param UserInterface $user
     * @param string        $action
     * @param bool|mixed    $default
     *
     * @return mixed
     */
    public function can($user, $action, $default = false)
    {
        $levelId = $this->levelId;
        $levelType = $this->levelType;

        if (null != $user) {
            $levelId = $user->getLevelId();
            $levelType = $user->getModelId();
        }

        if (!isset($this->data[$levelKey = $levelType . ':' . $levelId])) {
            $this->loadPermissionData($levelKey, $levelType, $levelId);
        }


        return (bool)$this->data[$levelKey]->get($action, $default);
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
            if (!_has($name)) {
                continue;
            }
            $result = _try('internal.cache',
                [$parent->getUniqueId(), $user->getUniqueId(), $name],
                0,
                function () use ($name, $parent, $user, $relationType) {
                    return _get($name)->getRelationships($parent, $user, $relationType);
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
        $levelType = $this->levelType;

        if (null != $user) {
            $levelId = $user->getLevelId();
            $levelType = $user->getModelId();
        }

        if (!isset($this->data[$levelKey = $levelType . ':' . $levelId])) {
            $this->loadPermissionData($levelKey, $levelType, $levelId);
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
    public function allow($user, $item, $action)
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
            $this->levelType = $target->getModelId();
        } else {
            $this->levelId = PHPFOX_GUEST_ID;
            $this->levelType = 'user';
        }
    }
}