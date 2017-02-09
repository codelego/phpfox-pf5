<?php

namespace Neutron\Core\Model;


class StorageDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $obj = new StorageDriver([
            'driver_id'   => 'local',
            'name'        => 'Local Storage',
            'form_name'   => '[Local Storage]',
            'description' => '[Local Description]',
            'is_active'   => '1',
        ]);

        $this->assertEquals('storage_driver', $obj->getModelId());
        $this->assertEquals('local', $obj->getId());
        $this->assertEquals('Local Storage', $obj->getName());
        $this->assertEquals('Local Storage', $obj->getTitle());
        $this->assertEquals('local', $obj->getDriverId());
        $this->assertEquals('[Local Storage]', $obj->getFormName());
        $this->assertEquals('[Local Description]', $obj->getDescription());
        $this->assertEquals('1', $obj->isActive());

        $obj->setName('[local]');
        $obj->setDescription('[local description]');
        $obj->setActive('0');
        $obj->setFormName('[form name]');

        $this->assertEquals('storage_driver', $obj->getModelId());
        $this->assertEquals('local', $obj->getId());
        $this->assertEquals('[local]', $obj->getName());
        $this->assertEquals('[local]', $obj->getTitle());
        $this->assertEquals('local', $obj->getDriverId());
        $this->assertEquals('[form name]', $obj->getFormName());
        $this->assertEquals('[local description]', $obj->getDescription());
        $this->assertEquals('0', $obj->isActive());
    }

    public function testSave()
    {
        $obj = new StorageDriver([
            'driver_id'   => '[local]',
            'name'        => '[Local Storage]',
            'form_name'   => '[local storage form name]',
            'description' => '[local description]',
            'is_active'   => '0',
        ]);

        $obj->save();

        /** @var StorageDriver $obj2 */
        $obj2 = \Phpfox::with('storage_driver')
            ->findById('[local]');

        $this->assertEquals('storage_driver', $obj2->getModelId());
        $this->assertEquals('[local]', $obj2->getId());
        $this->assertEquals('[Local Storage]', $obj2->getName());
        $this->assertEquals('[Local Storage]', $obj2->getTitle());
        $this->assertEquals('[local]', $obj2->getDriverId());
        $this->assertEquals('[local storage form name]', $obj2->getFormName());
        $this->assertEquals('[local description]', $obj2->getDescription());
        $this->assertEquals('0', $obj2->isActive());

        $obj2->delete();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::db()->delete(':storage_driver')
            ->where('driver_id=?', '[local]')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::db()->delete(':storage_driver')
            ->where('driver_id=?', '[local]')
            ->execute();
    }
}
