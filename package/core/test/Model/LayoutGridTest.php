<?php

namespace Neutron\Core\Model;

class LayoutGridTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutGrid(array (  'grid_id' => 'default',  'title' => 'Default',  'sort_order' => 1,  'description' => 'Single Column Grid',));

        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('default', $obj->getId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single Column Grid', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutGrid();

        // set data
        $obj->setId('default');
        $obj->setTitle('Default');
        $obj->setSortOrder(1);
        $obj->setDescription('Single Column Grid');

        // assert same data
        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('default', $obj->getId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single Column Grid', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutGrid(array (  'grid_id' => 'default',  'title' => 'Default',  'sort_order' => 1,  'description' => 'Single Column Grid',));

        $obj->save();

        /** @var LayoutGrid $obj */
        $obj = \Phpfox::with('layout_grid')
            ->select()->where('grid_id=?','default')->first();

        $this->assertSame('layout_grid', $obj->getModelId());
        $this->assertSame('default', $obj->getId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('Single Column Grid', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_grid')
            ->delete()->where('grid_id=?','default')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_grid')
            ->delete()->where('grid_id=?','default')->execute();
    }
}