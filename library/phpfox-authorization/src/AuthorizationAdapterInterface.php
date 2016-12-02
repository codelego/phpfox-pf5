<?php

namespace Phpfox\Authorization;

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