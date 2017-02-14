<?php

namespace Neutron\Core\Model;

class SessionDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new SessionDriver([
            'driver_id'    => '[database]',
            'driver_name'  => '[Database]',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ]);

        $this->assertSame('session_driver', $obj->getModelId());
        $this->assertSame('[database]', $obj->getId());
        $this->assertSame('[Database]', $obj->getDriverName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public function testParameters()
    {
        $obj = new SessionDriver();

        // set data
        $obj->setId('[database]');
        $obj->setDriverName('[Database]');
        $obj->setParams('[]');
        $obj->setDefault(1);
        $obj->setFormName('[form name]');
        $obj->setDriverClass('[driver class]');

        // assert same data
        $this->assertSame('session_driver', $obj->getModelId());
        $this->assertSame('[database]', $obj->getId());
        $this->assertSame('[Database]', $obj->getDriverName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public function testSave()
    {
        $obj = new SessionDriver([
            'driver_id'    => '[database]',
            'driver_name'  => '[Database]',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ]);

        $obj->save();

        /** @var SessionDriver $obj */
        $obj = \Phpfox::with('session_driver')
            ->select()->where('driver_id=?', '[database]')->first();

        $this->assertSame('session_driver', $obj->getModelId());
        $this->assertSame('[database]', $obj->getId());
        $this->assertSame('[Database]', $obj->getDriverName());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame('[form name]', $obj->getFormName());
        $this->assertSame('[driver class]', $obj->getDriverClass());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('session_driver')
            ->delete()->where('driver_id=?', '[database]')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('session_driver')
            ->delete()->where('driver_id=?', '[database]')->execute();
    }
}