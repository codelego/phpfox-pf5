<?php

namespace Neutron\Core\Model;

class CacheDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CacheDriver(array (  'driver_id' => 'files',  'driver_name' => 'File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\FilesDriverSettings',  'description' => 'Edit Files system settings',  'is_active' => 1,));

        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Edit Files system settings', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new CacheDriver();

        // set data
        $obj->setId('files');
        $obj->setDriverName('File System');
        $obj->setFormName('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings');
        $obj->setDescription('Edit Files system settings');
        $obj->setActive(1);

        // assert same data
        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Edit Files system settings', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new CacheDriver(array (  'driver_id' => 'files',  'driver_name' => 'File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\FilesDriverSettings',  'description' => 'Edit Files system settings',  'is_active' => 1,));

        $obj->save();

        /** @var CacheDriver $obj */
        $obj = _model('cache_driver')
            ->select()->where('driver_id=?','files')->first();

        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Edit Files system settings', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _model('cache_driver')
            ->delete()->where('driver_id=?','files')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('cache_driver')
            ->delete()->where('driver_id=?','files')->execute();
    }
}