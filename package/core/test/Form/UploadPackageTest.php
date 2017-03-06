<?php

namespace Neutron\Core\Form;


use Phpfox\Form\BootstrapFormRender;

class UploadPackageTest extends \PHPUnit_Framework_TestCase
{

    public function testInitialize()
    {
        $obj = new UploadPackage([]);

        $this->assertNotNull($obj->getElement('package'));

        $this->assertNotEmpty((new BootstrapFormRender())->render($obj));
    }
}
