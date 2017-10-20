<?php

namespace Neutron\User\Controller;


use Phpfox\View\ViewModel;

class AuthControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testLogin()
    {
        $obj = new AuthController();
        $this->assertTrue($obj->actionLogin() instanceof ViewModel);
    }

    public function testLogout()
    {
        $obj = new AuthController();
        $this->assertTrue($obj->actionLogout() instanceof ViewModel);
    }
}
