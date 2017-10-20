<?php

namespace Neutron\Friend\Model;

class FriendRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendRequest([
            'parent_id'  => 12,
            'user_id'    => 11,
            'status_id'  => 4,
            'created_at' => '2012-11-11 00:00:00',
        ]);

        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(11, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 00:00:00', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new FriendRequest();

        // set data
        $obj->setParentId(12);
        $obj->setUserId(11);
        $obj->setStatusId(4);
        $obj->setCreatedAt('2012-11-11 00:00:00');

        // assert same data
        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(11, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 00:00:00', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new FriendRequest([
            'parent_id'  => 12,
            'user_id'    => 11,
            'status_id'  => 4,
            'created_at' => '2012-11-11 00:00:00',
        ]);

        $obj->save();

        /** @var FriendRequest $obj */
        $obj = _model('friend_request')
            ->select()->where('parent_id=?', 12)->where('user_id=?', 11)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 00:00:00')->first();

        $this->assertSame('friend_request', $obj->getModelId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(11, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 00:00:00', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _model('friend_request')
            ->delete()->where('parent_id=?', 12)->where('user_id=?', 11)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 00:00:00')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('friend_request')
            ->delete()->where('parent_id=?', 12)->where('user_id=?', 11)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 00:00:00')->execute();
    }
}