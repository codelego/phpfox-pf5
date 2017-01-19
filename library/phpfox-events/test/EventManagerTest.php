<?php

namespace Phpfox\Event;


class EventManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $mn = new EventManager();

        $this->assertTrue($mn->initialize());

        $this->assertFalse($mn->initialize());

        $mn->clearListeners('exampleEventName');
    }

    public function testBase2()
    {
        $mn = new EventManager();

        $event = new Event('onExampleEvent', null, ['key1' => 'value1']);

        $response = $mn->trigger($event);


        $this->assertTrue($response->count() == 0);
    }

    public function testBase3()
    {
        $mn = new EventManager();

        $response = $mn->emit('onExampleEvent', new \stdClass(),
            ['key1' => 'value1']);


        $this->assertNull($response);
    }
}
