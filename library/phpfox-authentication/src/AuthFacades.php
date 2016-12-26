<?php

namespace Phpfox\Authentication;

use Neutron\User\Model\User;
use Phpfox\Support\UserInterface;

class AuthFacades
{
    /**
     * @var User
     */
    protected $loginAsUser;
    /**
     * @var UserInterface
     */
    protected $loginUser;

    /**
     * @var string
     */
    private $loginKey = 'LOGIN_USER_ID_';

    /**
     * @var string
     */
    private $userKey = 'LOGIN_AS_INFO_';

    /**
     * AuthFacades constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    private function initialize()
    {
        $session = \Phpfox::get('session');

        $loginInfo = $session->get($this->loginKey);

        if ($loginInfo) {
            $login = \Phpfox::findById('user', $loginInfo);

            if (!$login || !$login instanceof User) {
                $session->delete($this->loginKey);
                return;
            }

            $this->loginUser = $login;
            $userInfo = $session->get($this->userKey);

            if ($userInfo) {
                $user = \Phpfox::findById($userInfo[0], $userInfo[1]);

                if ($user) {
                    $this->loginAsUser = $user;
                }
            } elseif (!$this->loginAsUser) {
                $this->loginAsUser = $this->loginUser;
            }
        }
    }

    /**
     * @param mixed  $id
     * @param string $identity
     * @param string $credential
     * @param string $extra
     *
     * @return AuthResult
     */
    public function authenticate($id, $identity, $credential, $extra)
    {
        return \Phpfox::get('auth.factory')->factory($id)
            ->authenticate($identity, $credential, $extra);
    }

    /**
     * We can login as any terms
     * User / Pages/ Events/ Business ?
     *
     * @param User $user
     *
     * @param bool $persistent
     * @param bool $remember
     */
    public function login($user, $persistent, $remember)
    {
        $this->loginUser = $user;
        $this->loginAsUser = $user;

        if (!$persistent) {
            return;
        }

        $session = \Phpfox::get('session');

        // clear login as status
        $session->delete($this->userKey);
        $session->set($this->loginKey, $user->getId());

        if ($remember) {
            $session->remember();
        }
    }

    public function logout()
    {
        $this->loginAsUser = null;
        $this->loginUser = null;
        \Phpfox::get('session')->destroy();
    }

    /**
     * @param UserInterface|null $user
     * @param bool               $persistent
     */
    public function loginAs($user, $persistent)
    {

        if (!$this->loginUser) {
            throw new \InvalidArgumentException("Can not login as before login");
        }

        $this->loginAsUser = $user;

        if (!$persistent) {
            return;
        }

        $session = \Phpfox::get('session');

        if ($user == null) {
            $session->delete($this->userKey);
            return;
        }

        $session->set($this->userKey, [$user->getModelId(), $user->getId()]);
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        if (null == $this->loginAsUser) {
            return $this->loginUser;
        }
        return $this->loginAsUser;
    }

    /**
     * @return UserInterface
     */
    public function getLoginUser()
    {
        return $this->loginUser;
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


    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function __sleep()
    {
        return ['userKey', 'loginKey'];
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function __wakeup()
    {
        $this->initialize();
    }

}