<?php

namespace Neutron\Core\Controller;


class IndexControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new IndexController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
    }
}
