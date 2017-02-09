<?php

namespace Neutron\Core\Service;


use Phpfox\Storage\FileStorageInterface;

class FileStorageFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new FileStorageFactory();

        $this->assertSame(true, $obj->factory(null) instanceof FileStorageInterface);
        $this->assertSame(true, $obj->factory(0) instanceof FileStorageInterface);
        $this->assertSame(true, $obj->factory(1) instanceof FileStorageInterface);
        $this->assertSame(true, $obj->factory('default') instanceof FileStorageInterface);
        $this->assertSame(true, $obj->factory('fallback') instanceof FileStorageInterface);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testException()
    {
        $obj = new FileStorageFactory();

        $obj->factory(-1);
    }
}
