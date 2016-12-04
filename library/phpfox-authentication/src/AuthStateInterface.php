<?php

namespace Phpfox\Authentication;

/**
 * Interface StateInterface
 *
 * @package Phpfox\Auth
 */
interface AuthStateInterface
{
    public function read();

    public function write();
}