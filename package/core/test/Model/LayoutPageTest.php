<?php

namespace Neutron\Core\Model;

class LayoutPageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutPage(array (  'page_id' => 'blog_index_index',  'page_name' => 'Blog Home',  'package_id' => 'blog',  'description' => '',));

        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('Blog Home', $obj->getPageName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutPage();

        // set data
        $obj->setId('blog_index_index');
        $obj->setPageName('Blog Home');
        $obj->setPackageId('blog');
        $obj->setDescription('');

        // assert same data
        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('Blog Home', $obj->getPageName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutPage(array (  'page_id' => 'blog_index_index',  'page_name' => 'Blog Home',  'package_id' => 'blog',  'description' => '',));

        $obj->save();

        /** @var LayoutPage $obj */
        $obj = \Phpfox::with('layout_page')
            ->select()->where('page_id=?','blog_index_index')->first();

        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('Blog Home', $obj->getPageName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_page')
            ->delete()->where('page_id=?','blog_index_index')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_page')
            ->delete()->where('page_id=?','blog_index_index')->execute();
    }
}