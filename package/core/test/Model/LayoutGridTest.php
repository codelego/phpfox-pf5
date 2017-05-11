<?php
namespace Neutron\Core\Model;

class LayoutGridTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutGrid(array (  'grid_id' => 'simple',  'title' => 'Simple 1 column',  'sort_order' => 1,  'description' => 'Single column',  'locations' => '["main"]',));

        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('Simple 1 column', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single column', $obj->getDescription());
        $this->assertSame('["main"]', $obj->getLocations());    }

    public function testParameters()
    {
        $obj = new LayoutGrid();

        // set data
        $obj->setGridId('simple');
        $obj->setTitle('Simple 1 column');
        $obj->setSortOrder(1);
        $obj->setDescription('Single column');
        $obj->setLocations('["main"]');
        // assert same data
        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('Simple 1 column', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single column', $obj->getDescription());
        $this->assertSame('["main"]', $obj->getLocations());    }

    public function testSave()
    {
        $obj = new LayoutGrid(array (  'grid_id' => 'simple',  'title' => 'Simple 1 column',  'sort_order' => 1,  'description' => 'Single column',  'locations' => '["main"]',));

        $obj->save();

        /** @var LayoutGrid $obj */
        $obj = _model('layout_grid')
            ->select()->where('grid_id=?','simple')->first();

        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('Simple 1 column', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single column', $obj->getDescription());
        $this->assertSame('["main"]', $obj->getLocations());    }

    public static function setUpBeforeClass()
    {
        _model('layout_grid')
            ->delete()->where('grid_id=?','simple')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('layout_grid')
            ->delete()->where('grid_id=?','simple')->execute();
    }
}