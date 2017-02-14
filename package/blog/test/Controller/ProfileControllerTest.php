<?php

namespace Neutron\Blog\Controller;


use Phpfox\View\ViewModel;

class ProfileControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileController();
        $this->assertTrue($obj->actionIndex() instanceof ViewModel);
    }
}
