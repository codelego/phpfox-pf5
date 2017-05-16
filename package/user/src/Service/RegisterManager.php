<?php

namespace Neutron\User\Service;


class RegisterManager
{
    /**
     * @return array
     */
    public function getRegisterModeOptions()
    {
        return [
            ['value' => 'public', 'label' => 'Public, everyone can register a new account'],
            ['value' => 'admin_invite_only', 'label' => 'Admin Invite Only, everyone can register a new account'],
            ['value' => 'invite_only', 'label' => 'Invite Only, everyone can register a new account'],
            ['value' => 'disabled', 'label' => 'Disabled, Nobody can register a new account'],
        ];
    }
}