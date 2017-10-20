<?php

namespace Neutron\User\Service;


use Neutron\User\Model\UserVerifyToken;

class VerifyTokenManagerTest extends \PHPUnit_Framework_TestCase
{
    public function getGetTokenLength()
    {
        $obj = new VerifyTokenManager();

        $this->assertSame(16, $obj->getTokenLength());
    }

    public function testGenerateById()
    {
        $obj = new VerifyTokenManager();

        $this->assertSame($obj->getTokenLength(), strlen($obj->generateId()));
    }

    /**
     * @return mixed
     */
    public function testAddTokenByUserId()
    {
        $obj = new VerifyTokenManager();

        $token = $obj->addVerifyEmailTokenByUserId(12);

        $this->assertTrue($token instanceof UserVerifyToken);

        $this->assertSame('verify_email', $token->getReason());

        $this->assertTrue($token instanceof UserVerifyToken,
            'Expected ' . get_class($token));

        return $token->getId();
    }

    /**
     * @param mixed $id
     *
     * @return UserVerifyToken
     * @depends testAddTokenByUserId
     */
    public function testFindTokenById($id)
    {
        $obj = new VerifyTokenManager();

        $token = $obj->findById($id);

        $this->assertTrue($token instanceof UserVerifyToken);
        $this->assertSame('verify_email', $token->getReason());

        return $token;
    }

    public function testClean()
    {
        $obj = new VerifyTokenManager();

        $this->assertTrue($obj->clean());
    }
}
