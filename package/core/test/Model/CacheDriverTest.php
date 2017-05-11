<?php
namespace Neutron\Core\Model;

class CacheDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CacheDriver(array (  'driver_id' => 'files',  'driver_name' => 'File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\FilesDriverSettings',  'description' => 'Basic cache engine on file system',  'is_active' => 1,));

        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new CacheDriver();

        // set data
        $obj->setDriverId('files');
        $obj->setDriverName('File System');
        $obj->setFormName('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings');
        $obj->setDescription('Basic cache engine on file system');
        $obj->setActive(1);
        // assert same data
        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new CacheDriver(array (  'driver_id' => 'files',  'driver_name' => 'File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\CacheDriver\\FilesDriverSettings',  'description' => 'Basic cache engine on file system',  'is_active' => 1,));

        $obj->save();

        /** @var CacheDriver $obj */
        $obj = _model('cache_driver')
            ->select()->where('driver_id=?','files')->first();

        $this->assertSame('cache_driver', $obj->getModelId());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\CacheDriver\FilesDriverSettings', $obj->getFormName());
        $this->assertSame('Basic cache engine on file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());    }

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