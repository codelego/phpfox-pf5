<?php

namespace Neutron\User\Model;

class AuthRemoteTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AuthRemote([
            'id'           => 33,
            'remote_id'    => 'facebook',
            'remote_uid'   => 208445,
            'user_id'      => 22,
            'remote_token' => '[example token data]',
            'created_at'   => '2015-11-11 10:10:10',
        ]);

        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame('facebook', $obj->getRemoteId());
        $this->assertSame(208445, $obj->getRemoteUid());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[example token data]', $obj->getRemoteToken());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new AuthRemote();

        // set data
        $obj->setId(33);
        $obj->setRemoteId('facebook');
        $obj->setRemoteUid(208445);
        $obj->setUserId(22);
        $obj->setRemoteToken('[example token data]');
        $obj->setCreatedAt('2015-11-11 10:10:10');

        // assert same data
        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame('facebook', $obj->getRemoteId());
        $this->assertSame(208445, $obj->getRemoteUid());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[example token data]', $obj->getRemoteToken());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new AuthRemote([
            'id'           => 33,
            'remote_id'    => 'facebook',
            'remote_uid'   => 208445,
            'user_id'      => 22,
            'remote_token' => '[example token data]',
            'created_at'   => '2015-11-11 10:10:10',
        ]);

        $obj->save();

        /** @var AuthRemote $obj */
        $obj = \Phpfox::model('auth_remote')
            ->select()->where('id=?', 33)->first();

        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame('facebook', $obj->getRemoteId());
        $this->assertSame(208445, $obj->getRemoteUid());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[example token data]', $obj->getRemoteToken());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('auth_remote')
            ->delete()->where('id=?', 33)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('auth_remote')
            ->delete()->where('id=?', 33)->execute();
    }
}