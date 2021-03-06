<?php

namespace Neutron\Core\Model;

class LayoutBlockTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutBlock(['block_id'     => 1,
                                'parent_id'    => 0,
                                'container_id' => 1,
                                'location_id'  => 'main',
                                'component_id' => 'core.action_content',
                                'ordering'     => 1,
                                'is_active'    => 1,
                                'params'       => '[]',
        ]);

        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame(1, $obj->getBlockId());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('core.action_content', $obj->getComponentId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutBlock();

        // set data
        $obj->setBlockId(1);
        $obj->setParentId(0);
        $obj->setContainerId(1);
        $obj->setLocationId('main');
        $obj->setComponentId('core.action_content');
        $obj->setOrdering(1);
        $obj->setActive(1);
        $obj->setParams('[]');
        // assert same data
        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame(1, $obj->getBlockId());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('core.action_content', $obj->getComponentId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutBlock(['block_id'     => 1,
                                'parent_id'    => 0,
                                'container_id' => 1,
                                'location_id'  => 'main',
                                'component_id' => 'core.action_content',
                                'ordering'     => 1,
                                'is_active'    => 1,
                                'params'       => '[]',
        ]);

        $obj->save();

        /** @var LayoutBlock $obj */
        $obj = \Phpfox::model('layout_block')
            ->select()->where('block_id=?', 1)->first();

        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame(1, $obj->getBlockId());
        $this->assertSame(0, $obj->getParentId());
        $this->assertSame(1, $obj->getContainerId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame('core.action_content', $obj->getComponentId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('layout_block')
            ->delete()->where('block_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('layout_block')
            ->delete()->where('block_id=?', 1)->execute();
    }
}