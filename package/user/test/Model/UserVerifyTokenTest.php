<?php

namespace Neutron\User\Model;

class UserVerifyTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new UserVerifyToken([
            'token_id'   => 'dddd',
            'user_id'    => 22,
            'reason'     => 'none',
            'created_at' => '2012-11-10 00:00:00',
            'expires_at' => '2012-11-11 00:00:00',
        ]);

        $this->assertSame('user_verify_token', $obj->getModelId());
        $this->assertSame('dddd', $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('none', $obj->getReason());
        $this->assertSame('2012-11-10 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2012-11-11 00:00:00', $obj->getExpiresAt());
    }

    public function testParameters()
    {
        $obj = new UserVerifyToken();

        // set data
        $obj->setId('dddd');
        $obj->setUserId(22);
        $obj->setReason('none');
        $obj->setCreatedAt('2012-11-10 00:00:00');
        $obj->setExpiresAt('2012-11-11 00:00:00');

        // assert same data
        $this->assertSame('user_verify_token', $obj->getModelId());
        $this->assertSame('dddd', $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('none', $obj->getReason());
        $this->assertSame('2012-11-10 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2012-11-11 00:00:00', $obj->getExpiresAt());
    }

    public function testSave()
    {
        $obj = new UserVerifyToken([
            'token_id'   => 'dddd',
            'user_id'    => 22,
            'reason'     => 'none',
            'created_at' => '2012-11-10 00:00:00',
            'expires_at' => '2012-11-11 00:00:00',
        ]);

        $obj->save();

        /** @var UserVerifyToken $obj */
        $obj = \Phpfox::with('user_verify_token')
            ->select()->where('token_id=?', 'dddd')->first();

        $this->assertSame('user_verify_token', $obj->getModelId());
        $this->assertSame('dddd', $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('none', $obj->getReason());
        $this->assertSame('2012-11-10 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2012-11-11 00:00:00', $obj->getExpiresAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('user_verify_token')
            ->delete()->where('token_id=?', 'dddd')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('user_verify_token')
            ->delete()->where('token_id=?', 'dddd')->execute();
    }
}