<?php

namespace Phpfox\Authentication;

/**
 * Interface StateInterface
 *
 * @package Phpfox\Auth
 */
interface AuthenticationStateInterface
{
    public function read();

    public function write();
}