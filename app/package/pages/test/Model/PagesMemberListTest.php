<?php

namespace Neutron\Pages\Model;

class PagesMemberListTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesMemberList([
            'list_id'      => 5,
            'parent_id'    => 12,
            'type_id'      => 15,
            'member_count' => 26,
        ]);

        $this->assertSame('pages_member_list', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(15, $obj->getTypeId());
        $this->assertSame(26, $obj->getMemberCount());
    }

    public function testParameters()
    {
        $obj = new PagesMemberList();

        // set data
        $obj->setId(5);
        $obj->setParentId(12);
        $obj->setTypeId(15);
        $obj->setMemberCount(26);

        // assert same data
        $this->assertSame('pages_member_list', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(15, $obj->getTypeId());
        $this->assertSame(26, $obj->getMemberCount());
    }

    public function testSave()
    {
        $obj = new PagesMemberList([
            'list_id'      => 5,
            'parent_id'    => 12,
            'type_id'      => 15,
            'member_count' => 26,
        ]);

        $obj->save();

        /** @var PagesMemberList $obj */
        $obj = _model('pages_member_list')
            ->select()->where('list_id=?', 5)->where('parent_id=?', 12)
            ->where('type_id=?', 15)->where('member_count=?', 26)->first();

        $this->assertSame('pages_member_list', $obj->getModelId());
        $this->assertSame(5, $obj->getId());
        $this->assertSame(12, $obj->getParentId());
        $this->assertSame(15, $obj->getTypeId());
        $this->assertSame(26, $obj->getMemberCount());
    }

    public static function setUpBeforeClass()
    {
        _model('pages_member_list')
            ->delete()->where('list_id=?', 5)->where('parent_id=?', 12)
            ->where('type_id=?', 15)->where('member_count=?', 26)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('pages_member_list')
            ->delete()->where('list_id=?', 5)->where('parent_id=?', 12)
            ->where('type_id=?', 15)->where('member_count=?', 26)->execute();
    }
}