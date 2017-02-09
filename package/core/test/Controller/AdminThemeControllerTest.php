<?php

namespace Neutron\Core\Controller;


class AdminThemeControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AdminThemeController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionDebug());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionEdit());
    }

}
