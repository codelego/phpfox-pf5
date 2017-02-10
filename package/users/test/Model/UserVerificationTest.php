<?php

namespace Neutron\User\Model;


class UserVerificationTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new UserVerification([
            'id'         => 'test_token',
            'user_id'    => 8,
            'created'    => '2017-10-10 08:02:01',
            'expires_at' => 1477390174,
            'reason'     => 'verify_email',
        ]);

        $this->assertSame('user_verification', $obj->getModelId());
        $this->assertSame('test_token', $obj->getId());
        $this->assertSame(8, $obj->getUserId());
        $this->assertSame('2017-10-10 08:02:01', $obj->getCreated());
        $this->assertSame(1477390174, $obj->getExpiresAt());
        $this->assertSame('verify_email', $obj->getReason());
    }

    public function testSetter()
    {
        $obj = new UserVerification();

        $obj->setId('test_token_2');
        $obj->setUserId(14);
        $obj->setCreated('2012-10-10 08:02:01');
        $obj->setExpiresAt(1477390173);
        $obj->setReason('verify_email');

        $this->assertSame('user_verification', $obj->getModelId());
        $this->assertSame('test_token_2', $obj->getId());
        $this->assertSame(14, $obj->getUserId());
        $this->assertSame('2012-10-10 08:02:01', $obj->getCreated());
        $this->assertSame(1477390173, $obj->getExpiresAt());
        $this->assertSame('verify_email', $obj->getReason());
    }

    public function testSave()
    {
        $obj = new UserVerification([
            'id'         => 'test_token',
            'user_id'    => 8,
            'created'    => '2017-10-10 08:02:01',
            'expires_at' => 1477390174,
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
        $this->assertSame('2017-10-10 08:02:01', $obj->getCreated());
        $this->assertSame('1477390174', $obj->getExpiresAt());
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
