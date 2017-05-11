<?php
namespace Neutron\Core\Model;

class LogDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LogDriver(array (  'driver_id' => 'db',  'driver_name' => 'Log to database',  'form_name' => 'Neutron\\Core\\Form\\Admin\\LogDriver\\DatabaseDriverSettings',  'description' => 'Log to file system',  'is_active' => 1,  'sort_order' => 2,));

        $this->assertSame('log_driver', $obj->getModelId());
        $this->assertSame('db', $obj->getDriverId());
        $this->assertSame('Log to database', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\LogDriver\DatabaseDriverSettings', $obj->getFormName());
        $this->assertSame('Log to file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(2, $obj->getSortOrder());    }

    public function testParameters()
    {
        $obj = new LogDriver();

        // set data
        $obj->setDriverId('db');
        $obj->setDriverName('Log to database');
        $obj->setFormName('Neutron\Core\Form\Admin\LogDriver\DatabaseDriverSettings');
        $obj->setDescription('Log to file system');
        $obj->setActive(1);
        $obj->setSortOrder(2);
        // assert same data
        $this->assertSame('log_driver', $obj->getModelId());
        $this->assertSame('db', $obj->getDriverId());
        $this->assertSame('Log to database', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\LogDriver\DatabaseDriverSettings', $obj->getFormName());
        $this->assertSame('Log to file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(2, $obj->getSortOrder());    }

    public function testSave()
    {
        $obj = new LogDriver(array (  'driver_id' => 'db',  'driver_name' => 'Log to database',  'form_name' => 'Neutron\\Core\\Form\\Admin\\LogDriver\\DatabaseDriverSettings',  'description' => 'Log to file system',  'is_active' => 1,  'sort_order' => 2,));

        $obj->save();

        /** @var LogDriver $obj */
        $obj = _model('log_driver')
            ->select()->where('driver_id=?','db')->first();

        $this->assertSame('log_driver', $obj->getModelId());
        $this->assertSame('db', $obj->getDriverId());
        $this->assertSame('Log to database', $obj->getDriverName());
        $this->assertSame('Neutron\Core\Form\Admin\LogDriver\DatabaseDriverSettings', $obj->getFormName());
        $this->assertSame('Log to file system', $obj->getDescription());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(2, $obj->getSortOrder());    }

    public static function setUpBeforeClass()
    {
        _model('log_driver')
            ->delete()->where('driver_id=?','db')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('log_driver')
            ->delete()->where('driver_id=?','db')->execute();
    }
}