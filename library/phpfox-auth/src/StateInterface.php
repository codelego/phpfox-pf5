<?php

namespace Phpfox\Auth;

/**
 * Interface StateInterface
 *
 * @package Phpfox\Auth
 */
interface StateInterface
{
    public function read();

    public function write();
}