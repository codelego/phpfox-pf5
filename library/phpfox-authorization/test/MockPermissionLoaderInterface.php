<?php

namespace Phpfox\Authorization;


class MockPermissionLoaderInterface implements PermissionProviderInterface
{
    public function load($roleId)
    {
        return new PermissionData($roleId, [
            'is_super'      => 1,
            'is_admin'      => 1,
            'is_moderator'  => 1,
            'is_staff'      => 1,
            'is_banned'     => 0,
            'is_registered' => 1,
            'is_guest'      => 0,
        ]);
    }
}
