<?php

namespace Neutron\Friend\Model;


class FriendForwardTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendForward([
            'user_id'   => 4,
            'friend_id' => 12,
        ]);

        $this->assertEquals('friend_forward', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getFriendId());
    }

    public function testParameters()
    {
        $obj = new FriendForward();

        $obj->setUserId(4);
        $obj->setFriendId(12);

        $this->assertEquals('friend_forward', $obj->getModelId());
        $this->assertEquals(12, $obj->getFriendId());
        $this->assertEquals(4, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new FriendForward([
            'user_id'   => 4,
            'friend_id' => 12,
        ]);

        $obj->save();

        /** @var FriendForward $obj */
        $obj = \Phpfox::model('friend_forward')
            ->select()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->first();

        $this->assertEquals(true, $obj instanceof FriendForward);
        $this->assertEquals('friend_forward', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getFriendId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('friend_forward')
            ->delete()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('friend_forward')
            ->delete()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->execute();
    }
}
