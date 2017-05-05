<?php

namespace Neutron\Core\Controller;


class AdminMailControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AdminMailAdapterController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionAddTransport());
        $this->assertNull($obj->actionEditTransport());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionTransports());
    }
}
