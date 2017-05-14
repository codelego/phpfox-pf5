<?php

namespace Neutron\Core\Service;


use Phpfox\Storage\LocalFileStorage;

class FileStorageFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        _get('db')
            ->delete(':storage_adapter')
            ->execute();

        _get('db')->insert(':storage_adapter', [
            'adapter_id'   => 1,
            'adapter_name' => 'Local #1',
            'driver_id'    => 'local',
            'params'       => '[]',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '[description]',
        ])->execute();


        $obj = new FileStorageFactory();

        $this->assertSame(true,
            $obj->factory(null) instanceof LocalFileStorage);

        $this->assertSame(true,
            $obj->factory(0) instanceof LocalFileStorage);
        $this->assertSame(true,
            $obj->factory(1) instanceof LocalFileStorage);
        $this->assertSame(true,
            $obj->factory('default') instanceof LocalFileStorage);
        $this->assertSame(true,
            $obj->factory('fallback') instanceof LocalFileStorage);
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
