<?php

namespace Neutron\Core\Model;

class LayoutActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutAction(array (  'action_id' => 'blog_index_index',  'parent_action_id' => 'default',  'action_name' => 'Blog Home',  'package_id' => 'blog',  'is_admin' => 1,  'description' => 'Blog landing page',));

        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame('Blog landing page', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutAction();

        // set data
        $obj->setId('blog_index_index');
        $obj->setParentActionId('default');
        $obj->setActionName('Blog Home');
        $obj->setPackageId('blog');
        $obj->setAdmin(1);
        $obj->setDescription('Blog landing page');

        // assert same data
        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame('Blog landing page', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutAction(array (  'action_id' => 'blog_index_index',  'parent_action_id' => 'default',  'action_name' => 'Blog Home',  'package_id' => 'blog',  'is_admin' => 1,  'description' => 'Blog landing page',));

        $obj->save();

        /** @var LayoutAction $obj */
        $obj = _model('layout_action')
            ->select()->where('action_id=?','blog_index_index')->first();

        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame('Blog landing page', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('layout_action')
            ->delete()->where('action_id=?','blog_index_index')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('layout_action')
            ->delete()->where('action_id=?','blog_index_index')->execute();
    }
}