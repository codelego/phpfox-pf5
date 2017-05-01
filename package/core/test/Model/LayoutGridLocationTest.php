<?php

namespace Neutron\Core\Model;

class LayoutGridLocationTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutGridLocation(array (  'grid_id' => 'simple',  'location_id' => 'main',  'is_active' => 1,  'sort_order' => 1,  'description' => 'Main Column',));

        $this->assertSame('layout_grid_location', $obj->getModelId());
        $this->assertSame('simple', $obj->getId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Main Column', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutGridLocation();

        // set data
        $obj->setId('simple');
        $obj->setLocationId('main');
        $obj->setActive(1);
        $obj->setSortOrder(1);
        $obj->setDescription('Main Column');

        // assert same data
        $this->assertSame('layout_grid_location', $obj->getModelId());
        $this->assertSame('simple', $obj->getId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Main Column', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutGridLocation(array (  'grid_id' => 'simple',  'location_id' => 'main',  'is_active' => 1,  'sort_order' => 1,  'description' => 'Main Column',));

        $obj->save();

        /** @var LayoutGridLocation $obj */
        $obj = \Phpfox::with('layout_grid_location')
            ->select()->where('grid_id=?','simple')->first();

        $this->assertSame('layout_grid_location', $obj->getModelId());
        $this->assertSame('simple', $obj->getId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Main Column', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_grid_location')
            ->delete()->where('grid_id=?','simple')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_grid_location')
            ->delete()->where('grid_id=?','simple')->execute();
    }
}