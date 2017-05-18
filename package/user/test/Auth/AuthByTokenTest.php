<?php

namespace Neutron\User\Auth;

use Neutron\User\Model\AuthPassword;
use Neutron\User\Model\AuthToken;
use Neutron\User\Model\User;
use Phpfox\Auth\AuthResult;


class AuthByTokenTest extends \PHPUnit_Framework_TestCase
{
    /** @var  User */
    private static $user;
    /** @var  AuthPassword */
    private static $pwd;

    public function testSimple()
    {
        $obj = new AuthByToken();

        $result = $obj->authenticate('', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::MISSING_IDENTITY, $result->getCode());
        $this->assertSame('Missing login information.', $result->getMessage());
    }


    public function testInvalidCredential()
    {
        $obj = new AuthByToken();

        $result = $obj->authenticate('example_id', '');

        $this->assertSame(false, $result->isValid());
        $this->assertSame(AuthResult::INVALID_IDENTITY, $result->getCode());
        $this->assertSame('Invalid login information.', $result->getMessage());
    }

    public function testSuccess()
    {
        $obj = new AuthByToken();

        $result
            = $obj->authenticate('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            '');

        $this->assertSame(true, $result->isValid());
        $this->assertSame(AuthResult::SUCCESS, $result->getCode());
        $this->assertSame('Logged in successful.', $result->getMessage());
    }

    public static function setUpBeforeClass()
    {
        _get('db')->delete(':auth_token')
            ->where('id=?',
                '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
            ->execute();
        _get('db')->delete(':user')
            ->where('email=?', 'auth_token.unitest@example.com')
            ->execute();

        $user = new User([
            'role_id'       => 1,
            'user_photo_id' => 0,
            'gender'        => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'auth_remote_unitest',
            'fullname'      => 'Unit Test',
            'email'         => 'auth_token.unitest@example.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created_at'    => '2016-10-25 12:09:34',
        ]);
        $user->save();

        $pwd = new AuthToken([
            'id'         => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'    => $user->getId(),
            'expires_at' => '2015-11-11 10:10:20',
            'created_at' => '2015-11-11 10:10:10',
        ]);
        $pwd->save();

        self::$user = $user;
        self::$pwd = $pwd;
    }

    public static function tearDownAfterClass()
    {
//        _get('db')->delete(':auth_token')
//            ->where('id=?', '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
//            ->execute();
//        _get('db')->delete(':user')
//            ->where('email=?', 'auth_token.unitest@example.com')
//            ->execute();
    }
}
