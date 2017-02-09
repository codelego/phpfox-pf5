<?php

namespace Neutron\Core\Controller;


class AdminSettingsControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AdminSettingsController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
    }
}
