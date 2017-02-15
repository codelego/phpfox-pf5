<?php

namespace Neutron\Core\Controller;


use Phpfox\Action\Request;

class AdminAuthControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        Request::factory(['method' => 'get'])
            ->singleton();

        $controller = new AdminAuthController();

        $this->assertNull($controller->actionLogin());
    }
}
