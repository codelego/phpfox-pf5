<?php

namespace Neutron\Core\Service;


class EventLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadByEmpty()
    {
        $mn = new EventLoader();
        $data = $mn->load();
        $this->assertNotEmpty($data);
    }
}
