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
    public function _load($roleId)
    {
        $role = _get('core.roles')
            ->findById((int)$roleId);

        if (empty($role)) {
            $roleId = PHPFOX_GUEST_ID;

            $role = _get('core.roles')
                ->findById($roleId);
        }

        $items = _get('db')->select('*')
            ->from(':acl_setting_value')
            ->where('role_id=?', $roleId)
            ->execute()
            ->all();

        $data = [];

        foreach ($items as $item) {
            $key = sprintf('%s.%s', $item['group_name'], $item['action_name']);
            $data[$key] = json_decode($item['params'], true);
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

    public function load($roleId)
    {

        return _load(null, ['permission_provider', $roleId], 0, function () use ($roleId) {
            return $this->_load($roleId);
        });
    }
}