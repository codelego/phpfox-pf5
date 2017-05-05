<?php

namespace Neutron\Group\Model;

class GroupMemberListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupMemberList([
            'list_id'      => 1,
            'parent_id'    => 12,
            'type_id'      => 33,
            'member_count' => 44,
        ]);

        $this->assertSame('group_member_list', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(33, $obj->getTypeId());
        $this->assertSame(44, $obj->getMemberCount());
    }

    public function testParameters()
    {
        $obj = new GroupMemberList();

        // set data
        $obj->setId(1);
        $obj->setParentId(12);
        $obj->setTypeId(33);
        $obj->setMemberCount(44);

        // assert same data
        $this->assertSame('group_member_list', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(33, $obj->getTypeId());
        $this->assertSame(44, $obj->getMemberCount());
    }

    public function testSave()
    {
        $obj = new GroupMemberList([
            'list_id'      => 1,
            'parent_id'    => 12,
            'type_id'      => 33,
            'member_count' => 44,
        ]);

        $obj->save();

        /** @var GroupMemberList $obj */
        $obj = _with('group_member_list')
            ->select()->where('list_id=?', 1)->where('parent_id=?', 12)
            ->where('type_id=?', 33)->where('member_count=?', 44)->first();

        $this->assertSame('group_member_list', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(33, $obj->getTypeId());
        $this->assertSame(44, $obj->getMemberCount());
    }

    public static function setUpBeforeClass()
    {
        _with('group_member_list')
            ->delete()->where('list_id=?', 1)->where('parent_id=?', 12)
            ->where('type_id=?', 33)->where('member_count=?', 44)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('group_member_list')
            ->delete()->where('list_id=?', 1)->where('parent_id=?', 12)
            ->where('type_id=?', 33)->where('member_count=?', 44)->execute();
    }
}