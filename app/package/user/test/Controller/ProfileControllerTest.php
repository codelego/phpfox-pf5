<?php

namespace Neutron\User\Controller;


use Phpfox\View\ViewModel;

class ProfileControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testActionIndex()
    {
        $obj = new ProfileController();

        $this->assertTrue($obj->actionIndex() instanceof ViewModel);
    }
}
