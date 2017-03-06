<?php

namespace Neutron\Core\Model;

class LayoutBlockTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutBlock(array (  'block_id' => 'layout_content',  'block_name' => 'Content',  'form_class' => 'none',  'package_id' => 'core',  'is_active' => 1,));

        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame('layout_content', $obj->getId());
        $this->assertSame('Content', $obj->getBlockName());
        $this->assertSame('none', $obj->getFormClass());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new LayoutBlock();

        // set data
        $obj->setId('layout_content');
        $obj->setBlockName('Content');
        $obj->setFormClass('none');
        $obj->setPackageId('core');
        $obj->setActive(1);

        // assert same data
        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame('layout_content', $obj->getId());
        $this->assertSame('Content', $obj->getBlockName());
        $this->assertSame('none', $obj->getFormClass());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new LayoutBlock(array (  'block_id' => 'layout_content',  'block_name' => 'Content',  'form_class' => 'none',  'package_id' => 'core',  'is_active' => 1,));

        $obj->save();

        /** @var LayoutBlock $obj */
        $obj = \Phpfox::with('layout_block')
            ->select()->where('block_id=?','layout_content')->first();

        $this->assertSame('layout_block', $obj->getModelId());
        $this->assertSame('layout_content', $obj->getId());
        $this->assertSame('Content', $obj->getBlockName());
        $this->assertSame('none', $obj->getFormClass());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_block')
            ->delete()->where('block_id=?','layout_content')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_block')
            ->delete()->where('block_id=?','layout_content')->execute();
    }
}