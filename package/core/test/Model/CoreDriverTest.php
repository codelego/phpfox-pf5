<?php

namespace Neutron\Core\Model;

class CoreDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreDriver([
            'driver_identity'     => 1,
            'driver_id'           => 'files',
            'driver_type'         => 'cache',
            'form_settings_class' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\EditFilesSettings',
            'is_active'           => 1,
            'ordering'          => 1,
            'package_id'          => 'core',
            'title'               => 'File System',
            'description'         => 'Basic cache engine on file system',
        ]);

        $this->assertSame('core_driver', $obj->getModelId());
        $this->assertSame(1, $obj->getDriverIdentity());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('cache', $obj->getDriverType());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\EditFilesSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('File System', $obj->getTitle());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new CoreDriver();

        // set data
        $obj->setDriverIdentity(1);
        $obj->setDriverId('files');
        $obj->setDriverType('cache');
        $obj->setFormSettingsClass('Neutron\Core\Form\Admin\CacheDriver\EditFilesSettings');
        $obj->setActive(1);
        $obj->setOrdering(1);
        $obj->setPackageId('core');
        $obj->setTitle('File System');
        $obj->setDescription('Basic cache engine on file system');
        // assert same data
        $this->assertSame('core_driver', $obj->getModelId());
        $this->assertSame(1, $obj->getDriverIdentity());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('cache', $obj->getDriverType());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\EditFilesSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('File System', $obj->getTitle());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new CoreDriver([
            'driver_identity'     => 1,
            'driver_id'           => 'files',
            'driver_type'         => 'cache',
            'form_settings_class' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\EditFilesSettings',
            'is_active'           => 1,
            'ordering'          => 1,
            'package_id'          => 'core',
            'title'               => 'File System',
            'description'         => 'Basic cache engine on file system',
        ]);

        $obj->save();

        /** @var CoreDriver $obj */
        $obj = _model('core_driver')
            ->select()->where('driver_identity=?', 1)->first();

        $this->assertSame('core_driver', $obj->getModelId());
        $this->assertSame(1, $obj->getDriverIdentity());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('cache', $obj->getDriverType());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\EditFilesSettings', $obj->getFormSettingsClass());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('File System', $obj->getTitle());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('core_driver')
            ->delete()->where('driver_identity=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_driver')
            ->delete()->where('driver_identity=?', 1)->execute();
    }
}