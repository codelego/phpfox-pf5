<?php

namespace Neutron\Core\Controller;

class AdminIndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $controller = new AdminIndexController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $controller->actionIndex());
    }
}
