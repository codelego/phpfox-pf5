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
     * @param $levelId
     *
     * @return Parameters
     */
    public function get($levelId)
    {
        return isset($this->data[$levelId]) ? $this->data[$levelId]
            : $this->data[$levelId] = _get('package.loader')->getPermissionParameter($levelId);
    }

    /**
     * @param int        $levelId
     * @param Parameters $data
     */
    public function set($levelId, $data)
    {
        $this->data[$levelId] = $data;
    }

    /**
     * @param int|null   $levelId
     * @param string     $action
     * @param bool|mixed $default
     *
     * @return mixed
     */
    public function can($levelId, $action, $default = false)
    {
        if (null == $levelId) {
            $levelId = $this->levelId;
        }

        if (!isset($this->data[$levelId])) {
            $this->data[$levelId] = _get('package.loader')->_getPermissionParameter($levelId);
        }

        return (bool)$this->data[$levelId]->get($action, $default);
    }

    /**
     * @param UserInterface $user
     * @param ItemInterface $item
     * @param string        $action
     *
     * @return bool
     */
    public function check($user, $item, $action)
    {
        $levelId = $user->getLevelId();

        if (null == $levelId) {
            $levelId = $this->levelId;
        }

        if (!isset($this->data[$levelId])) {
            $this->data[$levelId] = _get('package.loader')->_getPermissionParameter($levelId);
        }

        $can = (bool)$this->data[$levelId]->get($action, true);

        if (!$can) {
            return false;
        }

        // cache relationship between user and item's owner, in process only.
        $relationships = $item->getOwnerRelationships($user);

        // cache privacy of in process
        $privacyId = $item->getPrivacyId($action);

        if (in_array($privacyId, $relationships)) {
            return true;
        }

        return false;
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
        // cache relationship between user and item's owner, in process only.
        $relationships = $item->getOwnerRelationships($user);

        // cache privacy of in process
        $privacyId = $item->getPrivacyId($action);

        if (in_array($privacyId, $relationships)) {
            return true;
        }

        return false;
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
        } else {
            $this->levelId = PHPFOX_GUEST_ID;
        }
    }

    /**
     * @return int
     */
    public function getLevelId()
    {
        return $this->levelId;
    }

    /**
     * @param int $value
     */
    public function setLevelId($value)
    {
        $this->levelId = (int)$value;
    }
}