<?php

namespace Neutron\User\Service;


class VerifyEmail
{
    /**
     * @param $tokenId
     *
     * @return array
     */
    public function findTokenById($tokenId)
    {
        return \Phpfox::db()
            ->select('*')
            ->from(':user_verify_email')
            ->where('id=?', (string)$tokenId)
            ->limit(1, 0)
            ->execute()
            ->first();
    }
}