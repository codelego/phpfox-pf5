<?php
namespace Neutron\User\Auth;


use Neutron\User\Model\AuthPassword;
use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;
use Phpfox\Authentication\PasswordCompatibleInterface;

class AuthByPassword implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();
        $user = $this->findUser($identity);

        if (!$user) {
            $result->setCode(AuthResult::INVALID_IDENTITY);
            return $result;
        }

        $userId = $user['user_id'];
        $result->setIdentity($userId);

        $isValid = $this->checkPasswordCompatible($credential, $userId);

        if (!$isValid) {
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        $result->setCode(AuthResult::SUCCESS);
        return $result;
    }

    /**
     * @param $identity
     *
     * @return array
     */
    private function findUser($identity)
    {
        if (strpos($identity, '@') !== false) {// check is email
            return \Phpfox::getDb()->select('user_id')->from(':user')
                ->where('email=?', $identity)->execute()->first();

        } elseif (false) {// check is phone number
            // todo implement find by phone number
        }

        return \Phpfox::getDb()->select('user_id')->from(':user')
            ->where('username=?', $identity)->execute()->first();
    }

    /**
     * @param $credential
     * @param $userId
     *
     * @return bool
     */
    private function checkPasswordCompatible($credential, $userId)
    {

        /** @var AuthPassword[] $candidates */
        $candidates = \Phpfox::getModel('auth_password')
            ->select()
            ->where('user_id=?', (int)$userId)
            ->execute()
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
    private function getPasswordChecker($id)
    {
        $driver = \Phpfox::getConfig('auth.passwords', $id);

        if (!$driver) {
            return null;
        }
        return new $driver;
    }
}