<?php

namespace Phpfox\Authentication;

class MockExampleUser
{
    protected $user_id = 1000;

    public function __construct($id)
    {
        $this->user_id = $id;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getModelId()
    {
        return 'example_user';
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}

class MockAuthBaseExample implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $authResult = new AuthResult();

        if (!$identity) {
            $authResult->setResult(AuthResult::MISSING_IDENTITY);
            return $authResult;
        }

        if (!$credential) {
            $authResult->setResult(AuthResult::MISSING_CREDENTIAL);
            return $authResult;
        }

        if ($identity != 'jack') {
            $authResult->setResult(AuthResult::INVALID_IDENTITY);
            return $authResult;
        }

        if ($credential != 'jack123') {
            $authResult->setResult(AuthResult::INVALID_CREDENTIAL);
            return $authResult;
        }

        $authResult->setResult(AuthResult::SUCCESS);
        $authResult->setIdentity(1000);
        return $authResult;
    }
}

class MockAuthFactory implements AuthFactoryInterface
{

    public function factory($id)
    {
        return new MockAuthBaseExample();
    }
}

class AuthFacadesTest extends \PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        \Phpfox::get('services')->set('auth.factory', new MockAuthFactory());
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('services')->set('auth.factory', null);
    }

    public function testBase()
    {
        $auth = new AuthFacades();

        $this->assertTrue(\Phpfox::get('auth.factory') instanceof
            MockAuthFactory);


        $authResult = $auth->authenticate(1, '', '', null);

        $this->assertFalse($authResult->isValid());
        $this->assertEquals(AuthResult::MISSING_IDENTITY,
            $authResult->getCode());
    }

    public function testBase2()
    {
        $auth = new AuthFacades();

        $authResult = $auth->authenticate(1, 'neil', '', null);

        $this->assertFalse($authResult->isValid());
        $this->assertEquals(AuthResult::MISSING_CREDENTIAL,
            $authResult->getCode());
    }

    public function testBase3()
    {
        $auth = new AuthFacades();

        $authResult = $auth->authenticate(1, 'neil', '', null);

        $this->assertFalse($authResult->isValid());
        $this->assertEquals(AuthResult::MISSING_CREDENTIAL,
            $authResult->getCode());
    }

    public function testBase4()
    {
        $auth = new AuthFacades();

        $authResult = $auth->authenticate(1, 'neil', 'neil', null);

        $this->assertFalse($authResult->isValid());
        $this->assertEquals(AuthResult::INVALID_IDENTITY,
            $authResult->getCode());
    }

    public function testBase5()
    {
        $auth = new AuthFacades();

        $authResult = $auth->authenticate(1, 'jack', 'neil', null);

        $this->assertFalse($authResult->isValid());
        $this->assertEquals(AuthResult::INVALID_CREDENTIAL,
            $authResult->getCode());
    }

    public function testBase6()
    {
        $auth = new AuthFacades();

        $authResult = $auth->authenticate(1, 'jack', 'jack123', null);

        $this->assertTrue($authResult->isValid());
        $this->assertEquals(AuthResult::SUCCESS, $authResult->getCode());
        $this->assertEquals(1000, $authResult->getIdentity());
    }

    public function testAuth1()
    {
        $user = new MockExampleUser(1000);
        $auth = new AuthFacades();

        $auth->login($user, false, 1);

        $this->assertEquals($user, $auth->getUser());
        $this->assertEquals($user, $auth->getLogin());
        $this->assertEquals($user->getUserId(), $auth->getLoginId());
        $this->assertTrue($auth->isLoggedIn());

        $this->assertTrue($auth->isLoggedIn());

        $auth->logout();

        $this->assertNull($auth->getUser());
        $this->assertNull($auth->getLogin());
        $this->assertEquals(0, $auth->getLoginId());

    }


    public function testAuth3()
    {
        $auth = new AuthFacades();

        $auth->logout();

        $loginUser = new MockExampleUser(1000);
        $loginAsUser = new MockExampleUser(10001);
        $auth->login($loginUser, true);
        $auth->loginAs($loginAsUser, true);

        $this->assertEquals($loginUser, $auth->getLogin());
        $this->assertEquals($loginAsUser, $auth->getUser());
        $this->assertEquals(true, $auth->isLoggedIn());
        $this->assertEquals(1000, $auth->getLoginId());
    }

    public function testAuth5()
    {
        $auth = new AuthFacades();

        $auth->logout();

        $loginUser = new MockExampleUser(1000);
        $loginAsUser = new MockExampleUser(10001);
        $auth->login($loginUser, true);
        $auth->loginAs($loginAsUser, true);

        $this->assertEquals($loginUser, $auth->getLogin());
        $this->assertEquals($loginAsUser, $auth->getUser());
        $this->assertEquals(true, $auth->isLoggedIn());
        $this->assertEquals(1000, $auth->getLoginId());
    }

    public function testAuth4()
    {
        $auth = new AuthFacades();

        $auth->logout();

        $loginUser = new MockExampleUser(1000);
        $auth->login($loginUser, true);

        $this->assertEquals($loginUser, $auth->getLogin());
        $this->assertEquals($loginUser, $auth->getUser());
        $this->assertEquals(true, $auth->isLoggedIn());
        $this->assertEquals(1000, $auth->getLoginId());
    }
}
