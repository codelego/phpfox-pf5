<?php

namespace Neutron\Friend\Model;


class FriendListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendList([
            'user_id' => 4,
            'list_id' => 12,
            'type_id' => 3,
            'name'    => '[example name]',
        ]);

        $this->assertEquals('friend_list', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getId());
        $this->assertEquals(3, $obj->getTypeId());
        $this->assertEquals('[example name]', $obj->getName());
    }

    public function testParameters()
    {
        $obj = new FriendList();

        $obj->setUserId(4);
        $obj->setId(12);
        $obj->setTypeId(3);
        $obj->setName('[example name]');


        $this->assertEquals('friend_list', $obj->getModelId());
        $this->assertEquals(12, $obj->getId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(3, $obj->getTypeId());
        $this->assertEquals('[example name]', $obj->getName());
    }

    public function testSave()
    {
        $obj = new FriendList([
            'user_id' => 4,
            'list_id' => 12,
            'type_id' => 3,
            'name'=>'[example name]',
        ]);

        $obj->save();

        /** @var FriendList $obj */
        $obj = \Phpfox::with('friend_list')
            ->select()
            ->where('list_id=?', 12)
            ->first();

        $this->assertEquals(true, $obj instanceof FriendList);
        $this->assertEquals('friend_list', $obj->getModelId());
        $this->assertEquals(4, $obj->getUserId());
        $this->assertEquals(12, $obj->getId());
        $this->assertEquals(3, $obj->getTypeId());
        $this->assertEquals('[example name]', $obj->getName());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('friend_list')
            ->delete()
            ->where('list_id=?', 12)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('friend_list')
            ->delete()
            ->where('list_id=?', 12)
            ->execute();
    }
}
