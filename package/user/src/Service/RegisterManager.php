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
            [
                'value' => 'invite_only',
                'label' => 'Invite Only, visitors can register a new account if got invitation code',
            ],
            ['value' => 'disabled', 'label' => 'Disabled, no one can register a new account'],
        ];
    }

    /**
     * @return array
     */
    public function getVerificationOptions()
    {
        return [
            ['value' => 'email', 'label' => 'Send verification code via email'],
            ['value' => 'sms', 'label' => 'Send verification code via SMS'],
        ];
    }
}