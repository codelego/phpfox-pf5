<?php

namespace Neutron\User\Controller;


class AdminManageControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AdminUserController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
    }
}
