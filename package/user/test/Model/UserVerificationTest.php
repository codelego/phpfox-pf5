<?php

namespace Neutron\User\Model;


class UserVerificationTest extends \PHPUnit_Framework_TestCase
{

    public function _testABC()
    {
        $user = new User([
            'role_id'       => 1,
            'user_photo_id' => 0,
            'gender'        => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'unit_test',
            'fullname'      => 'Unit Test',
            'email'         => 'unitest@example.com',
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

    }

    public function testBase()
    {
        $obj = new UserVerification([
            'id'         => 'test_token',
            'user_id'    => 8,
            'created_at' => '2017-10-10 08:02:01',
            'expires_at' => '2017-01-18 08:48:29',
            'reason'     => 'verify_email',
        ]);

        $this->assertSame('user_verification', $obj->getModelId());
        $this->assertSame('test_token', $obj->getId());
        $this->assertSame(8, $obj->getUserId());
        $this->assertSame('2017-10-10 08:02:01', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());
        $this->assertSame('verify_email', $obj->getReason());
    }

    public function testSetter()
    {
        $obj = new UserVerification();

        $obj->setId('test_token_2');
        $obj->setUserId(14);
        $obj->setCreatedAt('2012-10-10 08:02:01');
        $obj->setExpiresAt('2017-01-18 08:48:29');
        $obj->setReason('verify_email');

        $this->assertSame('user_verification', $obj->getModelId());
        $this->assertSame('test_token_2', $obj->getId());
        $this->assertSame(14, $obj->getUserId());
        $this->assertSame('2012-10-10 08:02:01', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());
        $this->assertSame('verify_email', $obj->getReason());
    }

    public function testSave()
    {
        $obj = new UserVerification([
            'id'         => 'test_token',
            'user_id'    => 8,
            'created_at' => '2017-10-10 08:02:01',
            'expires_at' => '2017-01-18 08:48:29',
            'reason'     => 'verify_email',
        ]);
        $obj->save();

        /** @var UserVerification $obj */
        $obj = \Phpfox::with('user_verification')
            ->findById('test_token');

        $this->assertNotNull($obj);

        $this->assertSame('user_verification', $obj->getModelId());
        $this->assertSame('test_token', $obj->getId());
        $this->assertSame(8, $obj->getUserId());
        $this->assertSame('2017-10-10 08:02:01', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());
        $this->assertSame('verify_email', $obj->getReason());

        $obj->delete();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')->delete(':user_verification')
            ->where('id=?', 'test_token')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')->delete(':user_verification')
            ->where('id=?', 'test_token')->execute();
    }

}
