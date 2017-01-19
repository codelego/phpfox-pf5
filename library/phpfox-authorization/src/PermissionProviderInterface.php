<?php

namespace Phpfox\Authorization;


interface PermissionProviderInterface
{
    /**
     * @param string $roleId
     *
     * @return PermissionData
     */
    public function load($roleId);
}