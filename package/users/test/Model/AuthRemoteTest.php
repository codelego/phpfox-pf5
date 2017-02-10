<?php

namespace Neutron\User\Model;


class AuthRemoteTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {

        $obj = new AuthRemote([
            'id'           => 2,
            'remote_id'    => 'facebook',
            'remote_uid'   => '44444',
            'user_id'      => 3,
            'remote_token' => 'test',
            'created'      => 4444,
        ]);

        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('facebook', $obj->getRemoteId());
        $this->assertSame('44444', $obj->getRemoteUid());
        $this->assertSame(3, $obj->getUserId());
        $this->assertSame('test', $obj->getRemoteToken());
        $this->assertSame(4444, $obj->getCreated());
    }

    public function testSetter()
    {

        $obj = new AuthRemote();

        $obj->setUserId('5');
        $obj->setRemoteId('66666');
        $obj->setRemoteUid('google');
        $obj->setCreated(5555);
        $obj->setRemoteToken('token');

        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame('66666', $obj->getRemoteId());
        $this->assertSame('google', $obj->getRemoteUid());
        $this->assertSame(5, $obj->getUserId());
        $this->assertSame('token', $obj->getRemoteToken());
        $this->assertSame('5555', $obj->getCreated());
    }

    public function testSave()
    {
        $obj = new AuthRemote([
            'id'           => 2,
            'remote_id'    => 'facebook',
            'remote_uid'   => '44444',
            'user_id'      => 3,
            'remote_token' => 'test',
            'created'      => 4444,
        ]);

        $obj->save();

        /** @var AuthRemote $obj */
        $obj = \Phpfox::with('auth_remote')
            ->select()
            ->where('remote_token=?', 'test')
            ->first();

        $this->assertNotNull($obj);
        $this->assertSame('auth_remote', $obj->getModelId());
        $this->assertSame('facebook', $obj->getRemoteId());
        $this->assertSame('44444', $obj->getRemoteUid());
        $this->assertSame('3', $obj->getUserId());
        $this->assertSame('test', $obj->getRemoteToken());
        $this->assertSame('4444', $obj->getCreated());
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_remote')
            ->where('remote_token=?', 'test')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_remote')
            ->where('remote_token=?', 'test')
            ->execute();
    }
}
