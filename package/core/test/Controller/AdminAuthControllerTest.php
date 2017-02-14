<?php

namespace Neutron\Core\Controller;


class AdminAuthControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $controller = new AdminAuthController();

        $this->assertNull($controller->actionLogin());
    }
}
