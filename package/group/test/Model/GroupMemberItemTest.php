<?php

namespace Neutron\Group\Model;

class GroupMemberItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupMemberItem(['list_id' => 23, 'user_id' => 44,]);

        $this->assertSame('group_member_item', $obj->getModelId());
        $this->assertSame(23, $obj->getId());
        $this->assertSame(44, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new GroupMemberItem();

        // set data
        $obj->setId(23);
        $obj->setUserId(44);

        // assert same data
        $this->assertSame('group_member_item', $obj->getModelId());
        $this->assertSame(23, $obj->getId());
        $this->assertSame(44, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new GroupMemberItem(['list_id' => 23, 'user_id' => 44,]);

        $obj->save();

        /** @var GroupMemberItem $obj */
        $obj = _with('group_member_item')
            ->select()->where('list_id=?', 23)->where('user_id=?', 44)->first();

        $this->assertSame('group_member_item', $obj->getModelId());
        $this->assertSame(23, $obj->getId());
        $this->assertSame(44, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        _with('group_member_item')
            ->delete()->where('list_id=?', 23)->where('user_id=?', 44)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('group_member_item')
            ->delete()->where('list_id=?', 23)->where('user_id=?', 44)
            ->execute();
    }
}