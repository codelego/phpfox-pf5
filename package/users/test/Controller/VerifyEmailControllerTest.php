<?php

namespace Neutron\User\Controller;


use Phpfox\View\ViewModel;

class VerifyEmailControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testVerify()
    {
        $obj = new VerifyEmailController();

        $this->assertFalse($obj->actionIndex() instanceof ViewModel);
    }
}
