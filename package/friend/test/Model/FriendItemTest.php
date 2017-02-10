<?php

namespace Neutron\Friend\Model;


class FriendItemTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new FriendItem([
            'list_id'   => 9,
            'friend_id' => 13,
        ]);

        $this->assertEquals('friend_item', $obj->getModelId());
        $this->assertEquals(9, $obj->getListId());
        $this->assertEquals(13, $obj->getFriendId());

    }

    public function testParameter()
    {
        $obj = new FriendItem();

        $obj->setListId(9);
        $obj->setFriendId(13);

        $this->assertEquals('friend_item', $obj->getModelId());
        $this->assertEquals(9, $obj->getListId());
        $this->assertEquals(13, $obj->getFriendId());
    }

    public function testSave()
    {
        $obj = new FriendItem();

        $obj->setListId(9);
        $obj->setFriendId(13);

        $obj->save();

        /** @var FriendItem $obj */
        $obj = \Phpfox::with('friend_item')
            ->select()
            ->where('friend_id=?', 13)
            ->where('list_id=?', 9)
            ->first();

        $this->assertTrue($obj instanceof FriendItem);

        $this->assertEquals('friend_item', $obj->getModelId());
        $this->assertEquals(9, $obj->getListId());
        $this->assertEquals(13, $obj->getFriendId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('friend_item')
            ->delete()
            ->where('friend_id=?', 13)
            ->where('list_id=?', 9)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('friend_item')
            ->delete()
            ->where('friend_id=?', 13)
            ->where('list_id=?', 9)
            ->execute();
    }
}
