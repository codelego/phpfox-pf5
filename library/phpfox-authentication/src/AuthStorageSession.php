<?php

namespace Phpfox\Authentication;

class AuthStorageSession implements AuthStorageInterface
{

    /**
     * @var string
     */
    protected $key = '_auth';

    public function __construct()
    {
        _get('session')->start();
    }


    public function initialize(AuthFacades $auth)
    {
        $info = _get('session')->get($this->key);

        if (!$info) {
            return false;
        }

        list($loginId, $userType, $userId) = $info;

        if ($userType == 'example_user') {
            return false;
        }

        if (!$loginId) {
            $this->forgot();
            return false;
        }

        $user = null;
        $login = \Phpfox::findById('user', $loginId);

        if ($userType != 'user' || ($userId != $loginId)) {
            $user = \Phpfox::findById($userType, $userId);
        }

        if (!$user) {
            $user = $login;
        }

        if ($login) {
            $auth->setUser($user);
            $auth->setLoginUser($login);
        } else {
            $this->forgot();
        }
        return true;
    }

    public function remember($userId, $loginAs, $loginAsId, $remember)
    {
        $session = _get('session');

        $session->set($this->key, [$userId, $loginAs, $loginAsId]);

        if ($remember) {
            $session->remember();
        }
    }

    public function forgot()
    {
        _get('session')->delete($this->key);
    }
}