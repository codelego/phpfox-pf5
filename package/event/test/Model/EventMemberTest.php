<?php

namespace Neutron\Event\Model;

class EventMemberTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventMember([
            'parent_id' => 22,
            'user_id'   => 4,
            'type_id'   => 1,
            'is_active' => 1,
        ]);

        $this->assertSame('event_member', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new EventMember();

        // set data
        $obj->setParentId(22);
        $obj->setUserId(4);
        $obj->setTypeId(1);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('event_member', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new EventMember([
            'parent_id' => 22,
            'user_id'   => 4,
            'type_id'   => 1,
            'is_active' => 1,
        ]);

        $obj->save();

        /** @var EventMember $obj */
        $obj = \Phpfox::with('event_member')
            ->select()->where('parent_id=?', 22)->where('user_id=?', 4)
            ->where('type_id=?', 1)->where('is_active=?', 1)->first();

        $this->assertSame('event_member', $obj->getModelId());
        $this->assertSame(22, $obj->getParentId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame(1, $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('event_member')
            ->delete()->where('parent_id=?', 22)->where('user_id=?', 4)
            ->where('type_id=?', 1)->where('is_active=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('event_member')
            ->delete()->where('parent_id=?', 22)->where('user_id=?', 4)
            ->where('type_id=?', 1)->where('is_active=?', 1)->execute();
    }
}