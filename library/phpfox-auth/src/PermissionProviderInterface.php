<?php

namespace Phpfox\Auth;


interface PermissionProviderInterface
{
    /**
     * @param string $roleId
     *
     * @return PermissionData
     */
    public function load($roleId);
}