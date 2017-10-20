<?php

namespace Neutron\User\Auth;

use Neutron\User\Model\AuthPassword;
use Neutron\User\Model\AuthRemote;
use Neutron\User\Model\User;
use Phpfox\Auth\AuthResult;

class AuthByRemoteTest extends \PHPUnit_Framework_TestCase
{
    /** @var  User */
    private static $user;
    /** @var  AuthPassword */
    private static $pwd;

    public function testSimple()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::MISSING_IDENTITY, $result->getCode());
        $this->assertSame('Missing login information.', $result->getMessage());
    }

    public function testMissingCredential()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('code@example.com', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::MISSING_CREDENTIAL, $result->getCode());
        $this->assertSame('Missing login information.', $result->getMessage());
    }

    public function testInvalidIdentity()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('example_id', 'password');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_IDENTITY, $result->getCode());
        $this->assertSame('Invalid login information.', $result->getMessage());
    }

    public function testInvalidCredential()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('example_id', 'password');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_IDENTITY, $result->getCode());
        $this->assertSame('Invalid login information.', $result->getMessage());
    }

    public function testSuccess()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('example_id', 'example_uid');

        $this->assertSame(true, $result->isValid());
        $this->assertSame(AuthResult::SUCCESS, $result->getCode());
        $this->assertSame('Logged in successful.', $result->getMessage());
    }

    public function testSuccess2()
    {
        $obj = new AuthByRemote();

        $result = $obj->authenticate('example_id', 'example_uid');

        $this->assertSame(true, $result->isValid());
        $this->assertSame(AuthResult::SUCCESS, $result->getCode());
        $this->assertSame('Logged in successful.', $result->getMessage());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')->delete(':user')
            ->where('email=?', 'auth_remote.unitest@example.com')
            ->execute();

        $user = new User([
            'level_id'      => 1,
            'user_photo_id' => 0,
            'gender'        => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'auth_remote_unitest',
            'fullname'      => 'Unit Test',
            'email'         => 'auth_remote.unitest@example.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created_at'    => '2016-10-25 12:09:34',
        ]);
        $user->save();

        $pwd = new AuthRemote([
            'id'           => 1,
            'remote_id'    => 'example_id',
            'remote_uid'   => 'example_uid',
            'user_id'      => $user->getId(),
            'remote_token' => 'example_token',
            'created_at'   => '2015-11-11 10:10:10',
        ]);
        $pwd->save();

        self::$user = $user;
        self::$pwd = $pwd;
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')->delete(':user')
            ->where('email=?', 'auth_remote.unitest@example.com')
            ->execute();

        self::$user->delete();
        self::$pwd->delete();
    }
}
