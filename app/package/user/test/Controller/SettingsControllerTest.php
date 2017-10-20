<?php

namespace Neutron\User\Controller;


use Phpfox\View\ViewModel;

class SettingsControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new SettingsController();
        $this->assertTrue($obj->actionIndex()
            instanceof ViewModel);
    }

    public function testActionLoginHistory()
    {
        $obj = new SettingsController();
        $this->assertTrue($obj->actionLoginHistory()
            instanceof ViewModel);
    }

    public function testActionSubscriptions()
    {
        $obj = new SettingsController();
        $this->assertFalse($obj->actionSubscriptions()
            instanceof ViewModel);
    }

}
