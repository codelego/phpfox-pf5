<?php

namespace Neutron\User\Service;


class EventListenerTest extends \PHPUnit_Framework_TestCase
{

    public function testOnSiteStatistics()
    {
        $obj = new EventListener();

        $this->assertNotEmpty($obj->onSiteStatistics());
    }
}
