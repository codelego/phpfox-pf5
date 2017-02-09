<?php

namespace Neutron\Core\Controller;


class ErrorControllerTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $obj = new ErrorController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->action404());
        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->action500());
    }
}
