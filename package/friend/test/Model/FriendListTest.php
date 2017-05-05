<?php

namespace Neutron\Friend\Model;

class FriendListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new FriendList([
            'list_id'   => 2,
            'parent_id' => 44,
            'type_id'   => 1,
            'name'      => '[customize]',
        ]);

        $this->assertSame('friend_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame('[customize]', $obj->getName());
    }

    public function testParameters()
    {
        $obj = new FriendList();

        // set data
        $obj->setId(2);
        $obj->setParentId(44);
        $obj->setTypeId(1);
        $obj->setName('[customize]');

        // assert same data
        $this->assertSame('friend_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame('[customize]', $obj->getName());
    }

    public function testSave()
    {
        $obj = new FriendList([
            'list_id'   => 2,
            'parent_id' => 44,
            'type_id'   => 1,
            'name'      => '[customize]',
        ]);

        $obj->save();

        /** @var FriendList $obj */
        $obj = _with('friend_list')
            ->select()->where('list_id=?', 2)->where('parent_id=?', 44)
            ->where('type_id=?', 1)->where('name=?', '[customize]')->first();

        $this->assertSame('friend_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(44, $obj->getParentId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame('[customize]', $obj->getName());
    }

    public static function setUpBeforeClass()
    {
        _with('friend_list')
            ->delete()->where('list_id=?', 2)->where('parent_id=?', 44)
            ->where('type_id=?', 1)->where('name=?', '[customize]')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('friend_list')
            ->delete()->where('list_id=?', 2)->where('parent_id=?', 44)
            ->where('type_id=?', 1)->where('name=?', '[customize]')->execute();
    }
}