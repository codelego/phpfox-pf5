<?php

namespace Neutron\User\Service;


use Neutron\User\Model\UserVerification;

class VerifyEmail
{
    /**
     * @param string $tokenId
     *
     * @return UserVerification
     */
    public function findTokenById($tokenId)
    {
        return \Phpfox::with('user_verification')
            ->findById((string)$tokenId);
    }
}