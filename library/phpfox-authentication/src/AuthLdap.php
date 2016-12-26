<?php

namespace Phpfox\Authentication;

/**
 * @codeCoverageIgnore
 */
class AuthLdap implements AuthInterface
{
    /**
     * @var array
     */
    protected $configs;

    /**
     * LdapAuthentication constructor.
     * Configs must contain
     * - port: int, default 389
     * - domain_controllers: string[]
     * - account_suffix: string, example: '@domain'
     * - base_dn: string
     * - admin_username: string
     * - admin_password: string
     *
     * @param array $configs
     */
    public function __construct($configs)
    {
        $this->configs = $configs;
    }

    public function authenticate($identity, $credential, $options = null)
    {

    }
}