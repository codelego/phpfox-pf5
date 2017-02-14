<?php

namespace Neutron\Core\Controller;


class AdminPackageControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminPackageController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionAdd());
    }
}
