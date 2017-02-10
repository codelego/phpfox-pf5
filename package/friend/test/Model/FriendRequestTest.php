<?php

namespace Neutron\Friend\Model;


class FriendRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendRequest([
            'id'             => 4,
            'user_id'        => 22,
            'friend_id'      => 8,
            'request_status' => 'sent',
            'created_at'     => '2014-09-08 22:11:00',
        ]);

        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(8, $obj->getFriendId());
        $this->assertSame('sent', $obj->getStatus());
        $this->assertSame('2014-09-08 22:11:00', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new FriendRequest();

        $obj->setCreatedAt('2014-09-08 22:11:00');
        $obj->setStatus('sent');
        $obj->setUserId(22);
        $obj->setFriendId(8);
        $obj->setId(4);

        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(8, $obj->getFriendId());
        $this->assertSame('sent', $obj->getStatus());
        $this->assertSame('2014-09-08 22:11:00', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new FriendRequest();

        $obj->setUserId(22);
        $obj->setFriendId(8);
        $obj->setStatus('sent');
        $obj->setCreatedAt('2014-09-08 22:11:00');

        $obj->save();

        /** @var FriendRequest $obj */
        $obj = \Phpfox::with('friend_request')
            ->select()
            ->where('user_id=?', 22)
            ->where('friend_id=?', 8)
            ->first();

        $this->assertNotNull($obj);
        $this->assertTrue($obj instanceof FriendRequest);
        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame(8, $obj->getFriendId());
        $this->assertSame('sent', $obj->getStatus());
        $this->assertSame('2014-09-08 22:11:00', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('friend_request')
            ->delete()
            ->where('user_id=?', 22)
            ->where('friend_id=?', 8)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('friend_request')
            ->delete()
            ->where('user_id=?', 22)
            ->where('friend_id=?', 8)
            ->execute();
    }
}
