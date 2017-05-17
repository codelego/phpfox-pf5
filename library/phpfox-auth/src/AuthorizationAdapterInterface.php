<?php

namespace Phpfox\Auth;

interface AuthorizationAdapterInterface
{
    /**
     * @param  string $id
     * @param  string $action
     *
     * @return bool
     */
    public function hasPermission($id, $action);
}