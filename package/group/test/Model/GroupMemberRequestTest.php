<?php

namespace Neutron\Group\Model;

class GroupMemberRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupMemberRequest([
            'parent_id'  => 22,
            'user_id'    => 44,
            'status_id'  => 4,
            'created_at' => '2012-11-11 11:11:11',
        ]);

        $this->assertSame('group_member_request', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 11:11:11', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new GroupMemberRequest();

        // set data
        $obj->setParentId(22);
        $obj->setUserId(44);
        $obj->setStatusId(4);
        $obj->setCreatedAt('2012-11-11 11:11:11');

        // assert same data
        $this->assertSame('group_member_request', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 11:11:11', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new GroupMemberRequest([
            'parent_id'  => 22,
            'user_id'    => 44,
            'status_id'  => 4,
            'created_at' => '2012-11-11 11:11:11',
        ]);

        $obj->save();

        /** @var GroupMemberRequest $obj */
        $obj = _with('group_member_request')
            ->select()->where('parent_id=?', 22)->where('user_id=?', 44)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 11:11:11')->first();

        $this->assertSame('group_member_request', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-11-11 11:11:11', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _with('group_member_request')
            ->delete()->where('parent_id=?', 22)->where('user_id=?', 44)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 11:11:11')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('group_member_request')
            ->delete()->where('parent_id=?', 22)->where('user_id=?', 44)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-11-11 11:11:11')->execute();
    }
}