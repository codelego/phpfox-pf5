<?php

namespace Neutron\Core\Model;

class LayoutParamsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutParams(array (  'id' => 1,  'page_id' => 'blog_index_index',  'theme_id' => 'default',  'params' => '["grid":"3"]',));

        $this->assertSame('layout_params', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutParams();

        // set data
        $obj->setId(1);
        $obj->setPageId('blog_index_index');
        $obj->setThemeId('default');
        $obj->setParams('["grid":"3"]');

        // assert same data
        $this->assertSame('layout_params', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutParams(array (  'id' => 1,  'page_id' => 'blog_index_index',  'theme_id' => 'default',  'params' => '["grid":"3"]',));

        $obj->save();

        /** @var LayoutParams $obj */
        $obj = \Phpfox::with('layout_params')
            ->select()->where('id=?',1)->first();

        $this->assertSame('layout_params', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('blog_index_index', $obj->getPageId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_params')
            ->delete()->where('id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_params')
            ->delete()->where('id=?',1)->execute();
    }
}