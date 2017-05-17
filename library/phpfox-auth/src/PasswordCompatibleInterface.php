<?php

namespace Phpfox\Auth;

interface PasswordCompatibleInterface
{
    /**
     * @param  string $input
     * @param  string $hashed
     * @param  string $salt
     * @param  string $static
     *
     * @return bool
     */
    public function isValid($input, $hashed, $salt, $static);

    /**
     * Generate hash string using input, salt, static_salt string
     *
     * @param string $input
     * @param string $salt
     * @param string $static
     *
     * @return string
     */
    public function createHash($input, $salt, $static = null);

    /**
     * Create random string to usage as salt.
     *
     * @param int $length
     *
     * @return string
     */
    public function createSalt($length = 5);
}