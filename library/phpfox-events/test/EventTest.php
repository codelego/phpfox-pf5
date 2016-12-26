<?php
namespace Phpfox\Event;


class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $event = new Event('onExampleEvent', null, ['key1' => 'value1']);

        $this->assertEquals(['key1' => 'value1'], $event->getParams());
        $this->assertNull($event->getTarget());
        $this->assertEquals('onExampleEvent', $event->getName());
        $this->assertEquals('value1', $event->getParam('key1'));
        $this->assertNull($event->getParam('key2'));
        $this->assertEquals('onExampleEvent', $event->__toString());

        $this->assertFalse($event->isStopped());

        $event->stop(true);

        $this->assertTrue($event->isStopped());
    }

    public function testBase2()
    {

        $target = new \stdClass();
        $event = new Event('onExampleEvent', $target, ['key1' => 'value1']);

        $this->assertEquals(['key1' => 'value1'], $event->getParams());
        $this->assertEquals('onExampleEvent', $event->getName());
        $this->assertEquals('value1', $event->getParam('key1'));
        $this->assertNull($event->getParam('key2'));
        $this->assertEquals('onExampleEvent', $event->__toString());
        $this->assertEquals($target, $event->getTarget());

        $this->assertFalse($event->isStopped());

        $event->stop(true);

        $this->assertTrue($event->isStopped());
    }
}
