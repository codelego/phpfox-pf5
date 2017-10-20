<?php

namespace Neutron\Friend\Model;

class FriendItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendItem(['list_id' => 12, 'user_id' => 45,]);

        $this->assertSame('friend_item', $obj->getModelId());
        $this->assertSame(12, $obj->getListId());
        $this->assertSame(45, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new FriendItem();

        // set data
        $obj->setListId(12);
        $obj->setUserId(45);

        // assert same data
        $this->assertSame('friend_item', $obj->getModelId());
        $this->assertSame(12, $obj->getListId());
        $this->assertSame(45, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new FriendItem(['list_id' => 12, 'user_id' => 45,]);

        $obj->save();

        /** @var FriendItem $obj */
        $obj = \Phpfox::model('friend_item')
            ->select()->where('list_id=?', 12)->where('user_id=?', 45)->first();

        $this->assertSame('friend_item', $obj->getModelId());
        $this->assertSame(12, $obj->getListId());
        $this->assertSame(45, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('friend_item')
            ->delete()->where('list_id=?', 12)->where('user_id=?', 45)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('friend_item')
            ->delete()->where('list_id=?', 12)->where('user_id=?', 45)
            ->execute();
    }
}