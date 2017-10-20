<?php

namespace Neutron\Event\Model;

class EventMemberItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventMemberItem(['list_id' => 4, 'user_id' => 41,]);

        $this->assertSame('event_member_item', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(41, $obj->getUserId());
    }

    public function testParameters()
    {
        $obj = new EventMemberItem();

        // set data
        $obj->setId(4);
        $obj->setUserId(41);

        // assert same data
        $this->assertSame('event_member_item', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(41, $obj->getUserId());
    }

    public function testSave()
    {
        $obj = new EventMemberItem(['list_id' => 4, 'user_id' => 41,]);

        $obj->save();

        /** @var EventMemberItem $obj */
        $obj = \Phpfox::model('event_member_item')
            ->select()->where('list_id=?', 4)->where('user_id=?', 41)->first();

        $this->assertSame('event_member_item', $obj->getModelId());
        $this->assertSame(4, $obj->getId());
        $this->assertSame(41, $obj->getUserId());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('event_member_item')
            ->delete()->where('list_id=?', 4)->where('user_id=?', 41)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('event_member_item')
            ->delete()->where('list_id=?', 4)->where('user_id=?', 41)
            ->execute();
    }
}