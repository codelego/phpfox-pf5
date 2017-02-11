<?php

namespace Neutron\User\Auth;

use Neutron\User\Model\AuthPassword;
use Neutron\User\Model\AuthToken;
use Neutron\User\Model\User;
use Phpfox\Authentication\AuthResult;


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
        \Phpfox::db()->delete(':auth_token')
            ->where('id=?',
                '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
            ->execute();
        \Phpfox::db()->delete(':user')
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
            'created'       => 1477389808,
        ]);
        $user->save();

        $pwd = new AuthToken([
            'id'       => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'  => $user->getId(),
            'updated'  => time(),
            'lifetime' => 86400,
        ]);
        $pwd->save();

        self::$user = $user;
        self::$pwd = $pwd;
    }

    public static function tearDownAfterClass()
    {
//        \Phpfox::db()->delete(':auth_token')
//            ->where('id=?', '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
//            ->execute();
//        \Phpfox::db()->delete(':user')
//            ->where('email=?', 'auth_token.unitest@example.com')
//            ->execute();
    }
}