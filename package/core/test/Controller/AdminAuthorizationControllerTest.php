<?php

namespace Neutron\Core\Controller;


class AdminAuthorizationControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminAclController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionEdit());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionDelete());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionSettings());
    }
}
