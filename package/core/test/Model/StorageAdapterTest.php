<?php

namespace Neutron\Core\Model;


class StorageAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $obj = new StorageAdapter([
            'adapter_id'  => 1,
            'name'        => 'Local',
            'driver_id'   => 'local',
            'params'      => '[]',
            'is_active'   => 1,
            'is_default'  => 1,
            'is_fallback' => 1,
            'description' => '[description]',
        ]);

        $this->assertEquals('storage_adapter', $obj->getModelId());

        $this->assertEquals(1, $obj->getId());
        $this->assertEquals(1, $obj->getAdapterId());
        $this->assertEquals('local', $obj->getDriverId());
        $this->assertEquals('Local', $obj->getName());
        $this->assertEquals('Local', $obj->getTitle());
        $this->assertEquals('[]', $obj->getParams());
        $this->assertEquals('[description]', $obj->getDescription());
        $this->assertEquals(1, $obj->isActive());
        $this->assertEquals(1, $obj->isDefault());
        $this->assertEquals(1, $obj->isFallback());

        $obj->setName('[test adapter]');
        $obj->setDriverId('[local]');
        $obj->setParams('[test param]');
        $obj->setDescription('[test description]');
        $obj->setParams('[test params]');
        $obj->setActive(0);
        $obj->setFallback(0);
        $obj->setDefault(0);

        $this->assertEquals(1, $obj->getId());
        $this->assertEquals(1, $obj->getAdapterId());
        $this->assertEquals('[local]', $obj->getDriverId());
        $this->assertEquals('[test adapter]', $obj->getName());
        $this->assertEquals('[test adapter]', $obj->getTitle());
        $this->assertEquals('[test params]', $obj->getParams());
        $this->assertEquals('[test description]', $obj->getDescription());
        $this->assertEquals(0, $obj->isActive());
        $this->assertEquals(0, $obj->isDefault());
        $this->assertEquals(0, $obj->isFallback());
    }

    public function testSave()
    {
        $obj = new StorageAdapter([
            'name'        => '[test adapter]',
            'driver_id'   => '[local]',
            'params'      => '[test param]',
            'is_active'   => 0,
            'is_default'  => 0,
            'is_fallback' => 0,
            'description' => '[test description]',
        ]);

        $obj->save();

        /** @var StorageAdapter $entry */
        $entry = \Phpfox::with('storage_adapter')
            ->select()
            ->where('driver_id=?', '[local]')
            ->first();

        $this->assertEquals('[local]', $entry->getDriverId());
        $this->assertEquals('[test adapter]', $entry->getName());
        $this->assertEquals('[test adapter]', $entry->getTitle());
        $this->assertEquals('[test param]', $entry->getParams());
        $this->assertEquals('[test description]', $entry->getDescription());
        $this->assertEquals(0, $entry->isActive());
        $this->assertEquals(0, $entry->isDefault());
        $this->assertEquals(0, $entry->isFallback());


    }

    public static function tearDownAfterClass()
    {
        \Phpfox::db()
            ->delete(':storage_adapter')
            ->where('driver_id=?', '[local]')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::db()
            ->delete(':storage_adapter')
            ->where('driver_id=?', '[local]')
            ->execute();
    }
}
