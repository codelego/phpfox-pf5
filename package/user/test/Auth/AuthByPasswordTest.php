<?php

namespace Neutron\User\Auth;


use Neutron\User\Model\AuthPassword;
use Neutron\User\Model\User;
use Phpfox\Authentication\AuthResult;

class AuthByPasswordTest extends \PHPUnit_Framework_TestCase
{
    /** @var  User */
    private static $user;
    /** @var  AuthPassword */
    private static $pwd;

    public function testSimple()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::MISSING_IDENTITY, $result->getCode());
        $this->assertSame('Missing login information.', $result->getMessage());
    }

    public function testMissingCredential()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('code@example.com', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::MISSING_CREDENTIAL, $result->getCode());
        $this->assertSame('Missing login information.', $result->getMessage());
    }

    public function testInvalidIdentity()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('code.unitest0@example.com', 'password');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_IDENTITY, $result->getCode());
        $this->assertSame('Invalid login information.', $result->getMessage());
    }

    public function testInvalidCredential()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('code.unitest@example.com', 'password');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_CREDENTIAL, $result->getCode());
        $this->assertSame('Incorrect password.', $result->getMessage());
    }

    public function testInvalidCredential2()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('unit_test', 'password');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_CREDENTIAL, $result->getCode());
        $this->assertSame('Incorrect password.', $result->getMessage());
    }

    public function testSuccess()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('code.unitest@example.com', '123456');

        $this->assertSame(true, $result->isValid());
        $this->assertSame(AuthResult::SUCCESS, $result->getCode());
        $this->assertSame('Logged in successful.', $result->getMessage());
    }

    public function testSuccess2()
    {
        $obj = new AuthByPassword();

        $result = $obj->authenticate('unit_test', '123456');

        $this->assertSame(true, $result->isValid());
        $this->assertSame(AuthResult::SUCCESS, $result->getCode());
        $this->assertSame('Logged in successful.', $result->getMessage());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::db()->delete(':user')
            ->where('email=?', 'code.unitest@example.com')
            ->execute();

        $user = new User([
            'role_id'       => 1,
            'user_photo_id' => 0,
            'gender'        => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'unit_test',
            'fullname'      => 'Unit Test',
            'email'         => 'code.unitest@example.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created_at'    => '2016-10-25 12:09:34',
        ]);
        $user->save();

        $pwd = new AuthPassword([
            'user_id'     => $user->getId(),
            'hashed'      => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'salt'        => 'OJ$',
            'static_salt' => '',
            'source_id'   => 'pf4',
            'updated'     => 1477389808,
        ]);
        $pwd->save();

        self::$user = $user;
        self::$pwd = $pwd;
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::db()->delete(':user')
            ->where('email=?', 'code.unitest@example.com')
            ->execute();

        self::$user->delete();
        self::$pwd->delete();
    }
}
