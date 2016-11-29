<?php

namespace Phpfox\Auth;

/**
 * Interface PasswordValidatorInterface
 *
 * @package Phpfox\Auth
 */
interface AuthPasswordInterface
{
    /**
     * @param  string $input
     * @param  array  $params
     *
     * @return bool
     */
    public function isValid($input, $params);

    /**
     * Generate hash string using input, salt, static_salt string
     *
     * @param string $input
     * @param string $salt
     * @param string $static_salt
     *
     * @return string
     */
    public function createHash($input, $salt, $static_salt = null);

    /**
     * Create random string to usage as salt.
     *
     * @param int $length
     *
     * @return string
     */
    public function createSalt($length = 5);
}