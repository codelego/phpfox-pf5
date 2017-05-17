<?php

namespace Phpfox\Authentication;

use Neutron\User\Model\User;
use Phpfox\Support\UserInterface;

class AuthFacades
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var UserInterface
     */
    private $loginUser;

    /**
     * AuthFacades constructor.
     */
    public function __construct()
    {
        _get('auth.storage')->initialize($this);
    }

    protected function initialize()
    {
        _trigger('onAuthInit', $this);
    }

    /**
     * @param mixed  $id
     * @param string $identity
     * @param string $credential
     * @param array  $extra
     *
     * @return AuthResult
     */
    public function authenticate($id, $identity, $credential, $extra)
    {
        return _get('auth.factory')->factory($id)
            ->authenticate($identity, $credential, $extra);
    }

    /**
     * We can login as any terms
     * User / Pages/ Events/ Business ?
     *
     * @param UserInterface|mixed $user
     * @param bool                $remember
     */
    public function login($user, $remember)
    {
        $this->user = $user;
        $this->loginUser = $user;

        _trigger('onUserLogin', $user);

        $this->remember($remember);

    }

    protected function remember($remember)
    {
        $loginId = $this->getLoginId();

        $userType = 'user';
        $userId = $loginId;
        $user = $this->getUser();

        if ($user) {
            $userType = $user->getModelId();
            $userId = $user->getId();
        }

        _get('auth.storage')
            ->remember($loginId, $userType, $userId, $remember);
    }

    protected function forgot()
    {
        _get('auth.storage')->forgot();
    }

    public function logout()
    {
        $this->user = null;
        $this->loginUser = null;
        _get('auth.storage')->forgot();
    }

    /**
     * @param UserInterface|mixed $user
     * @param bool                $remember
     */
    public function loginAs($user, $remember)
    {
        $this->user = $user;

        $this->remember($remember);
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getLogin()
    {
        return $this->loginUser;
    }

    /**
     * @param UserInterface $loginUser
     */
    public function setLoginUser($loginUser)
    {
        $this->loginUser = $loginUser;
        _trigger('onLoginUser', $loginUser);
    }

    public function isLoggedIn()
    {
        return $this->loginUser != null;
    }

    public function getLoginId()
    {
        if (!$this->loginUser) {
            return 0;
        }

        return $this->loginUser->getId();
    }
}