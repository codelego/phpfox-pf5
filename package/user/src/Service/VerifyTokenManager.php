<?php

namespace Neutron\User\Service;

use Neutron\User\Model\UserVerifyToken;

class VerifyTokenManager
{
    /**
     * Get length of token string
     *
     * @return int
     */
    public function getTokenLength()
    {
        return 16;
    }

    /**
     *
     * Return random string with 16 alphabet numeric character length
     *
     * @return string
     */
    public function generateId()
    {
        return _random_string($this->getTokenLength());
    }

    /**
     * Add UserVerifyToken entry associate with user id
     *
     * @param mixed  $userId
     * @param string $reason
     * @param int    $lifetime
     *
     * @return UserVerifyToken
     */
    public function addTokenByUserId($userId, $reason, $lifetime = 86400)
    {
        $obj = new UserVerifyToken([
            'token_id'   => $this->generateId(),
            'user_id'    => (int)$userId,
            'created_at' => date('Y-m-d H:i:s', time()),
            'expires_at' => date('Y-m-d H:i:s', time() + $lifetime),
            'reason'     => (string)$reason,
        ]);

        $obj->save();

        return $obj;
    }

    /**
     * @see VerifyTokenManager::addTokenByUserId()
     *
     * Add email verify token string associate with userId
     *
     * @param mixed $userId
     *
     * @return UserVerifyToken
     */
    public function addVerifyEmailTokenByUserId($userId)
    {
        return $this->addTokenByUserId($userId, 'verify_email');
    }

    /**
     * @param string $id
     *
     * @return UserVerifyToken
     */
    public function findById($id)
    {
        return _with('user_verify_token')
            ->findById((string)$id);
    }

    /**
     * @return true
     */
    public function clean()
    {
        _get('db')->delete(':user_verify_token')
            ->where('expires_at<?', date('Y-m-d H:i:s', time()))->execute();

        return true;
    }
}