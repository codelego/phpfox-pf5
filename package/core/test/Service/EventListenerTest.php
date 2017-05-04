<?php

namespace Neutron\Core\Service;

class EventListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $obj = new EventListener();

        $this->assertNotNull($obj->onBootstrap());
        $this->assertNotNull($obj->onRebuildFiles());
        $this->assertNotNull($obj->onSystemHealthCheck());
        $this->assertEquals(12, count($obj->onSystemHealthCheck()));
    }
}