<?php

namespace Neutron\Group\Model;

class GroupMemberTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupMember([
            'parent_id' => 13,
            'user_id'   => 44,
            'type_id'   => 2,
            'is_active' => 1,
        ]);

        $this->assertSame('group_member', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(2, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new GroupMember();

        // set data
        $obj->setParentId(13);
        $obj->setUserId(44);
        $obj->setTypeId(2);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('group_member', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(2, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new GroupMember([
            'parent_id' => 13,
            'user_id'   => 44,
            'type_id'   => 2,
            'is_active' => 1,
        ]);

        $obj->save();

        /** @var GroupMember $obj */
        $obj = \Phpfox::with('group_member')
            ->select()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('type_id=?', 2)->where('is_active=?', 1)->first();

        $this->assertSame('group_member', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(2, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('group_member')
            ->delete()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('type_id=?', 2)->where('is_active=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('group_member')
            ->delete()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('type_id=?', 2)->where('is_active=?', 1)->execute();
    }
}