<?php
namespace Phpfox\Auth;

/**
 * Interface AdapterInterface
 *
 * @package Phpfox\Auth
 */
interface AdapterInterface
{
    /**
     * @return AuthResult
     */
    public function authenticate();
}