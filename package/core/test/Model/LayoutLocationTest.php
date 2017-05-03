<?php

namespace Neutron\Core\Model;

class LayoutLocationTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutLocation(array (  'container_id' => 1,  'location_id' => 'main',  'params' => '[]',));

        $this->assertSame('layout_location', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutLocation();

        // set data
        $obj->setContainerId(1);
        $obj->setLocationId('main');
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('layout_location', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutLocation(array (  'container_id' => 1,  'location_id' => 'main',  'params' => '[]',));

        $obj->save();

        /** @var LayoutLocation $obj */
        $obj = \Phpfox::with('layout_location')
            ->select()->where('container_id=?',1)->where('location_id=?','main')->first();

        $this->assertSame('layout_location', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_location')
            ->delete()->where('container_id=?',1)->where('location_id=?','main')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_location')
            ->delete()->where('container_id=?',1)->where('location_id=?','main')->execute();
    }
}