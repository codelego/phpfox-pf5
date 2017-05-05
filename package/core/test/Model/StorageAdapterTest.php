<?php

namespace Neutron\Core\Model;

class StorageAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageAdapter([
            'adapter_id'   => 1,
            'adapter_name' => 'Local',
            'driver_id'    => 'local',
            'params'       => '[]',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '',
        ]);

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new StorageAdapter();

        // set data
        $obj->setId(1);
        $obj->setAdapterName('Local');
        $obj->setDriverId('local');
        $obj->setParams('[]');
        $obj->setActive(1);
        $obj->setDefault(1);
        $obj->setFallback(1);
        $obj->setDescription('');

        // assert same data
        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new StorageAdapter([
            'adapter_id'   => 1,
            'adapter_name' => 'Local',
            'driver_id'    => 'local',
            'params'       => '[]',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '',
        ]);

        $obj->save();

        /** @var StorageAdapter $obj */
        $obj = _with('storage_adapter')
            ->select()->where('adapter_id=?', 1)->first();

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _with('storage_adapter')
            ->delete()->where('adapter_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('storage_adapter')
            ->delete()->where('adapter_id=?', 1)->execute();
    }
}