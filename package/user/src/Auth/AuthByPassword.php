<?php

namespace Neutron\User\Auth;


use Neutron\User\Model\AuthPassword;
use Neutron\User\Model\User;
use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;
use Phpfox\Authentication\PasswordCompatibleInterface;

class AuthByPassword implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        if (!$identity) {
            $result->setResult(AuthResult::MISSING_IDENTITY);
            return $result;
        }

        if (!$credential) {
            $result->setResult(AuthResult::MISSING_CREDENTIAL);
            return $result;
        }

        $user = $this->findUser($identity);

        if (!$user) {
            $result->setResult(AuthResult::INVALID_IDENTITY, null);
            return $result;
        }

        $userId = $user->getId();
        $result->setIdentity($userId);

        $isValid = $this->checkPassword($credential, $userId);

        if (!$isValid) {
            $result->setResult(AuthResult::INVALID_CREDENTIAL, null);
            return $result;
        }

        $result->setResult(AuthResult::SUCCESS, null);
        return $result;
    }

    /**
     * @param $identity
     *
     * @return User
     */
    private function findUser($identity)
    {
        if (strpos($identity, '@') !== false) {// check is email
            return \Phpfox::with('user')
                ->select()
                ->where('email=?', $identity)
                ->first();

        }

        return \Phpfox::with('user')
            ->select()
            ->where('username=?', $identity)
            ->first();
    }

    /**
     * @param $credential
     * @param $userId
     *
     * @return bool
     */
    public function checkPassword($credential, $userId)
    {

        /** @var AuthPassword[] $candidates */
        $candidates = \Phpfox::with('auth_password')
            ->select()
            ->where('user_id=?', (int)$userId)
            ->all();

        foreach ($candidates as $ca) {
            $checker = $this->getPasswordChecker($ca->getSourceId());

            if (!$checker) {
                continue;
            }

            if ($checker->isValid($credential, $ca->getHashed(),
                $ca->getSalt(), $ca->getStaticSalt())
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $id
     *
     * @return PasswordCompatibleInterface
     */
    public function getPasswordChecker($id)
    {
        $driver = \Phpfox::getParam('auth.passwords', $id);

        if (!$driver) {
            return null;
        }
        return new $driver;
    }
}