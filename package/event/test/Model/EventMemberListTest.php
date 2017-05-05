<?php

namespace Neutron\Event\Model;

class EventMemberListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventMemberList([
            'list_id'      => 2,
            'parent_id'    => 4,
            'type_id'      => 5,
            'member_count' => 15,
        ]);

        $this->assertSame('event_member_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getParentId());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(15, $obj->getMemberCount());
    }

    public function testParameters()
    {
        $obj = new EventMemberList();

        // set data
        $obj->setId(2);
        $obj->setParentId(4);
        $obj->setTypeId(5);
        $obj->setMemberCount(15);

        // assert same data
        $this->assertSame('event_member_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getParentId());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(15, $obj->getMemberCount());
    }

    public function testSave()
    {
        $obj = new EventMemberList([
            'list_id'      => 2,
            'parent_id'    => 4,
            'type_id'      => 5,
            'member_count' => 15,
        ]);

        $obj->save();

        /** @var EventMemberList $obj */
        $obj = _with('event_member_list')
            ->select()->where('list_id=?', 2)->where('parent_id=?', 4)
            ->where('type_id=?', 5)->where('member_count=?', 15)->first();

        $this->assertSame('event_member_list', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame(4, $obj->getParentId());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(15, $obj->getMemberCount());
    }

    public static function setUpBeforeClass()
    {
        _with('event_member_list')
            ->delete()->where('list_id=?', 2)->where('parent_id=?', 4)
            ->where('type_id=?', 5)->where('member_count=?', 15)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('event_member_list')
            ->delete()->where('list_id=?', 2)->where('parent_id=?', 4)
            ->where('type_id=?', 5)->where('member_count=?', 15)->execute();
    }
}