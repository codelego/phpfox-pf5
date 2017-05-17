<?php

namespace Phpfox\Auth;

interface AuthStorageInterface
{
    public function forgot();


    /**
     * @param AuthFacades $auth
     *
     * @return bool
     */
    public function initialize(AuthFacades $auth);

    /**
     * @param string $userId
     * @param string $loginAs
     * @param string $loginAsId
     * @param bool   $remember
     *
     * @return bool
     */
    public function remember($userId, $loginAs, $loginAsId, $remember);
}