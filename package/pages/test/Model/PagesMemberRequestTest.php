<?php

namespace Neutron\Pages\Model;

class PagesMemberRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesMemberRequest([
            'parent_id'  => 13,
            'user_id'    => 44,
            'status_id'  => 66,
            'created_at' => '2014-12-12 00:11:44',
        ]);

        $this->assertSame('pages_member_request', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(66, $obj->getStatusId());
        $this->assertSame('2014-12-12 00:11:44', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new PagesMemberRequest();

        // set data
        $obj->setParentId(13);
        $obj->setUserId(44);
        $obj->setStatusId(66);
        $obj->setCreatedAt('2014-12-12 00:11:44');

        // assert same data
        $this->assertSame('pages_member_request', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(66, $obj->getStatusId());
        $this->assertSame('2014-12-12 00:11:44', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new PagesMemberRequest([
            'parent_id'  => 13,
            'user_id'    => 44,
            'status_id'  => 66,
            'created_at' => '2014-12-12 00:11:44',
        ]);

        $obj->save();

        /** @var PagesMemberRequest $obj */
        $obj = _with('pages_member_request')
            ->select()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('status_id=?', 66)
            ->where('created_at=?', '2014-12-12 00:11:44')->first();

        $this->assertSame('pages_member_request', $obj->getModelId());
        $this->assertSame(13, $obj->getParentId());
        $this->assertSame(44, $obj->getUserId());
        $this->assertSame(66, $obj->getStatusId());
        $this->assertSame('2014-12-12 00:11:44', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _with('pages_member_request')
            ->delete()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('status_id=?', 66)
            ->where('created_at=?', '2014-12-12 00:11:44')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('pages_member_request')
            ->delete()->where('parent_id=?', 13)->where('user_id=?', 44)
            ->where('status_id=?', 66)
            ->where('created_at=?', '2014-12-12 00:11:44')->execute();
    }
}