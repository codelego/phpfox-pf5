<?php

namespace Neutron\Core\Model;

class LayoutElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutElement(array (  'id' => 1,  'page_id' => 'blog_index_index',  'theme_id' => 'default',  'block_id' => 'layout_content',  'location_id' => 'main',  'sort_order' => 1,  'is_active' => 1,  'params' => '[]',));

        $this->assertSame('layout_element', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('layout_content', $obj->getBlockId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutElement();

        // set data
        $obj->setId(1);
        $obj->setPageId('blog_index_index');
        $obj->setThemeId('default');
        $obj->setBlockId('layout_content');
        $obj->setLocationId('main');
        $obj->setSortOrder(1);
        $obj->setActive(1);
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('layout_element', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('layout_content', $obj->getBlockId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutElement(array (  'id' => 1,  'page_id' => 'blog_index_index',  'theme_id' => 'default',  'block_id' => 'layout_content',  'location_id' => 'main',  'sort_order' => 1,  'is_active' => 1,  'params' => '[]',));

        $obj->save();

        /** @var LayoutElement $obj */
        $obj = \Phpfox::with('layout_element')
            ->select()->where('id=?',1)->first();

        $this->assertSame('layout_element', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('layout_content', $obj->getBlockId());
        $this->assertSame('main', $obj->getLocationId());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_element')
            ->delete()->where('id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_element')
            ->delete()->where('id=?',1)->execute();
    }
}