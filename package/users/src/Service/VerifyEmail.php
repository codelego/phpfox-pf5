<?php

namespace Neutron\User\Service;

use Neutron\User\Model\UserVerification;

class VerifyEmail
{
    /**
     * @param string $id
     *
     * @return UserVerification
     */
    public function findById($id)
    {
        return \Phpfox::with('user_verification')
            ->findById((string)$id);
    }
}