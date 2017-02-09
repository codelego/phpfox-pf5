<?php

namespace Neutron\Core\Model;


class StorageFileTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $obj = new StorageFile([]);

        $this->assertEquals('storage_file', $obj->getModelId());
    }
}
