<?php

namespace Neutron\Friend\Model;


class FriendTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new Friend([
            'user_id'   => 4,
            'friend_id' => 12,
        ]);

        $this->assertEquals('friend', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getFriendId());
    }

    public function testParameters()
    {
        $obj = new Friend();

        $obj->setUserId(4);
        $obj->setFriendId(12);

        $this->assertEquals('friend', $obj->getModelId());
        $this->assertEquals(12, $obj->getFriendId());
        $this->assertEquals(4, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new Friend([
            'user_id'   => 4,
            'friend_id' => 12,
        ]);

        $obj->save();

        /** @var Friend $obj */
        $obj = _model('friend')
            ->select()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->first();

        $this->assertEquals(true, $obj instanceof Friend);
        $this->assertEquals('friend', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getFriendId());
    }

    public static function setUpBeforeClass()
    {
        _model('friend')
            ->delete()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('friend')
            ->delete()
            ->where('user_id=?', 4)
            ->where('friend_id=?', 12)
            ->execute();
    }
}
