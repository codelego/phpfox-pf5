<?php

namespace Neutron\Event\Model;

class EventMemberRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventMemberRequest([
            'parent_id'  => 1,
            'user_id'    => 3,
            'status_id'  => 4,
            'created_at' => '2012-10-10 09:09:09',
        ]);

        $this->assertSame('event_member_request', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(3, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-10-10 09:09:09', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new EventMemberRequest();

        // set data
        $obj->setParentId(1);
        $obj->setUserId(3);
        $obj->setStatusId(4);
        $obj->setCreatedAt('2012-10-10 09:09:09');

        // assert same data
        $this->assertSame('event_member_request', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(3, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-10-10 09:09:09', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new EventMemberRequest([
            'parent_id'  => 1,
            'user_id'    => 3,
            'status_id'  => 4,
            'created_at' => '2012-10-10 09:09:09',
        ]);

        $obj->save();

        /** @var EventMemberRequest $obj */
        $obj = \Phpfox::with('event_member_request')
            ->select()->where('parent_id=?', 1)->where('user_id=?', 3)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-10-10 09:09:09')->first();

        $this->assertSame('event_member_request', $obj->getModelId());
        $this->assertSame(1, $obj->getParentId());
        $this->assertSame(3, $obj->getUserId());
        $this->assertSame(4, $obj->getStatusId());
        $this->assertSame('2012-10-10 09:09:09', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('event_member_request')
            ->delete()->where('parent_id=?', 1)->where('user_id=?', 3)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-10-10 09:09:09')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('event_member_request')
            ->delete()->where('parent_id=?', 1)->where('user_id=?', 3)
            ->where('status_id=?', 4)
            ->where('created_at=?', '2012-10-10 09:09:09')->execute();
    }
}