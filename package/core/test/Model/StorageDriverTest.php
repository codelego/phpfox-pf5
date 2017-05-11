<?php
namespace Neutron\Core\Model;

class StorageDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageDriver(array (  'driver_id' => 'ftp',  'driver_name' => 'FTP, FTPs - Virual File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\StorageDriver\\FtpDriverSettings',  'description' => 'FTP/FTPs - Virual File System',  'is_active' => 1,  'driver_class' => '',));

        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('ftp', $obj->getDriverId());
        $this->assertSame('FTP, FTPs - Virual File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\StorageDriver\FtpDriverSettings', $obj->getFormName());
        $this->assertSame('FTP/FTPs - Virual File System', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDriverClass());    }

    public function testParameters()
    {
        $obj = new StorageDriver();

        // set data
        $obj->setDriverId('ftp');
        $obj->setDriverName('FTP, FTPs - Virual File System');
        $obj->setFormName('Neutron\Core\Form\Admin\StorageDriver\FtpDriverSettings');
        $obj->setDescription('FTP/FTPs - Virual File System');
        $obj->setActive(1);
        $obj->setDriverClass('');
        // assert same data
        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('ftp', $obj->getDriverId());
        $this->assertSame('FTP, FTPs - Virual File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\StorageDriver\FtpDriverSettings', $obj->getFormName());
        $this->assertSame('FTP/FTPs - Virual File System', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDriverClass());    }

    public function testSave()
    {
        $obj = new StorageDriver(array (  'driver_id' => 'ftp',  'driver_name' => 'FTP, FTPs - Virual File System',  'form_name' => 'Neutron\\Core\\Form\\Admin\\StorageDriver\\FtpDriverSettings',  'description' => 'FTP/FTPs - Virual File System',  'is_active' => 1,  'driver_class' => '',));

        $obj->save();

        /** @var StorageDriver $obj */
        $obj = _model('storage_driver')
            ->select()->where('driver_id=?','ftp')->first();

        $this->assertSame('storage_driver', $obj->getModelId());
        $this->assertSame('ftp', $obj->getDriverId());
        $this->assertSame('FTP, FTPs - Virual File System', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\StorageDriver\FtpDriverSettings', $obj->getFormName());
        $this->assertSame('FTP/FTPs - Virual File System', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDriverClass());    }

    public static function setUpBeforeClass()
    {
        _model('storage_driver')
            ->delete()->where('driver_id=?','ftp')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('storage_driver')
            ->delete()->where('driver_id=?','ftp')->execute();
    }
}