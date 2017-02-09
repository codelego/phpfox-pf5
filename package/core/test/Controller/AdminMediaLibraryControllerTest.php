<?php

namespace Neutron\Core\Controller;


class AdminMediaLibraryControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminMediaLibraryController();

        $this->assertNull($obj->actionIndex());
    }
}
