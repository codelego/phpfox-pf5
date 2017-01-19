<?php

namespace Neutron\Core\Service;


use Phpfox\Authorization\PermissionData;
use Phpfox\Authorization\PermissionProviderInterface;

class PermissionProvider implements PermissionProviderInterface
{
    /**
     * @param int $roleId
     *
     * @return PermissionData
     */
    public function load($roleId)
    {
        $role = \Phpfox::get('core.roles')
            ->findById($roleId);

        if (null == $roleId) {
            $roleId = PHPFOX_GUEST_ID;
        }

        if (null == $role) {
            $role = \Phpfox::get('core.roles')->findById($roleId);
        }

        $items = \Phpfox::get('db')->select('*')
            ->from(':core_permission')
            ->where('role_id=?', $roleId)
            ->execute()
            ->all();

        $data = [];

        foreach ($items as $item) {
            $key = sprintf('%s.%s', $item['group_name'], $item['action_name']);
            $value = false;
            if (!empty($item['params'])) {
                $data = json_decode($item['params'], true);
                if (isset($data['val'])) {
                    $value = $data['val'];
                }
            }
            $data[$key] = $value;
        }
        $data['is_super'] = $role->isSuper();
        $data['is_admin'] = $role->isAdmin();
        $data['is_moderator'] = $role->isModerator();
        $data['is_staff'] = $role->isStaff();
        $data['is_banned'] = $role->isBanned();
        $data['is_registered'] = $role->isRegistered();
        $data['is_guest'] = $role->isGuest();

        return new PermissionData($roleId, $data);
    }

    /**
     * @inheritdoc
     */
    public function _load($roleId)
    {

        return \Phpfox::get('cache.local')
            ->with(['PermissionProvider', $roleId], function () use ($roleId) {
                return $this->_load($roleId);
            });
    }
}