<?php

namespace Neutron\Event\Model;

class EventLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventLevel(['level_id' => 1, 'inherit_id' => 0, 'title' => 'Default', 'item_count' => 0, 'is_core' => 1,]);

        $this->assertSame('event_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
    }

    public function testParameters()
    {
        $obj = new EventLevel();

        // set data
        $obj->setLevelId(1);
        $obj->setInheritId(0);
        $obj->setTitle('Default');
        $obj->setItemCount(0);
        $obj->setCore(1);
        // assert same data
        $this->assertSame('event_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
    }

    public function testSave()
    {
        $obj = new EventLevel(['level_id' => 1, 'inherit_id' => 0, 'title' => 'Default', 'item_count' => 0, 'is_core' => 1,]);

        $obj->save();

        /** @var EventLevel $obj */
        $obj = \Phpfox::model('event_level')
            ->select()->where('level_id=?', 1)->first();

        $this->assertSame('event_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('event_level')
            ->delete()->where('level_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('event_level')
            ->delete()->where('level_id=?', 1)->execute();
    }
}