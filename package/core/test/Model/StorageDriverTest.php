<?php

namespace Neutron\Core\Model;

class StorageDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageDriver([
            'driver_id'    => '[local]',
            'driver_name'  => '[Local]',
            'form_name'    => '[form name]',
            'description'  => '[description]',
            'is_active'    => 1,
            'driver_class' => '[driver class]',
        ]);

        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('[local]', $obj->getId());
        $this->assertSame('[Local]', $obj->getDriverName());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public function testParameters()
    {
        $obj = new StorageDriver();

        // set data
        $obj->setId('[local]');
        $obj->setDriverName('[Local]');
        $obj->setFormName('[form name]');
        $obj->setDescription('[description]');
        $obj->setActive(1);
        $obj->setDriverClass('[driver class]');

        // assert same data
        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('[local]', $obj->getId());
        $this->assertSame('[Local]', $obj->getDriverName());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public function testSave()
    {
        $obj = new StorageDriver([
            'driver_id'    => '[local]',
            'driver_name'  => '[Local]',
            'form_name'    => '[form name]',
            'description'  => '[description]',
            'is_active'    => 1,
            'driver_class' => '[driver class]',
        ]);

        $obj->save();

        /** @var StorageDriver $obj */
        $obj = _with('storage_driver')
            ->select()->where('driver_id=?', '[local]')->first();

        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('[local]', $obj->getId());
        $this->assertSame('[Local]', $obj->getDriverName());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public static function setUpBeforeClass()
    {
        _with('storage_driver')
            ->delete()->where('driver_id=?', '[local]')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('storage_driver')
            ->delete()->where('driver_id=?', '[local]')->execute();
    }
}