<?php

namespace Neutron\Core\Model;

class LayoutContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutContainer([
            'container_id' => 1,
            'page_id'      => 1,
            'grid_id'      => 'simple',
            'type_id'      => 'container',
            'is_active'    => 1,
            'ordering'   => 0,
            'params'       => '[]',
        ]);

        $this->assertSame('layout_container', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame(1, $obj->getPageId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('container', $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutContainer();

        // set data
        $obj->setContainerId(1);
        $obj->setPageId(1);
        $obj->setGridId('simple');
        $obj->setTypeId('container');
        $obj->setActive(1);
        $obj->setOrdering(0);
        $obj->setParams('[]');
        // assert same data
        $this->assertSame('layout_container', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame(1, $obj->getPageId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('container', $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutContainer([
            'container_id' => 1,
            'page_id'      => 1,
            'grid_id'      => 'simple',
            'type_id'      => 'container',
            'is_active'    => 1,
            'ordering'   => 0,
            'params'       => '[]',
        ]);

        $obj->save();

        /** @var LayoutContainer $obj */
        $obj = _model('layout_container')
            ->select()->where('container_id=?', 1)->first();

        $this->assertSame('layout_container', $obj->getModelId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame(1, $obj->getPageId());
        $this->assertSame('simple', $obj->getGridId());
        $this->assertSame('container', $obj->getTypeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        _model('layout_container')
            ->delete()->where('container_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('layout_container')
            ->delete()->where('container_id=?', 1)->execute();
    }
}