<?php

namespace Phpfox\Kernel;


class ServiceManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $mn = new ServiceContainer();

        $this->assertFalse($mn->has('no-service'));

        $this->assertInstanceOf('Phpfox\Logger\LogContainer',
            $mn->get('main.log'));

        $this->assertFalse($mn->get('main.log') === $mn->build('main.log'));
    }
}
