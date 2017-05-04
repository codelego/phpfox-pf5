<?php

namespace Neutron\Core\Controller;


class AdminStatusControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminStatusController();

        $this->assertNull($obj->actionCache());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionHealthCheck());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionLicense());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionOverview());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionStatistics());
    }
}
