<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CorePackage;

class PackagesTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $obj = new PackageManager();

        $this->assertEquals(true, $obj->findById(1) instanceof CorePackage);

        $this->assertEquals(null, $obj->findById(null));
    }
}
