<?php

namespace Neutron\Core\Model;

class LayoutActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutAction(['action_id'        => 'blog_index_index',
                                 'parent_action_id' => 'default',
                                 'action_name'      => 'Blog Home',
                                 'package_id'       => 'blog',
                                 'description'      => 'Blog landing page',
        ]);

        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
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
        $obj->setDescription('Blog landing page');

        // assert same data
        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog landing page', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutAction(['action_id'        => 'blog_index_index',
                                 'parent_action_id' => 'default',
                                 'action_name'      => 'Blog Home',
                                 'package_id'       => 'blog',
                                 'description'      => 'Blog landing page',
        ]);

        $obj->save();

        /** @var LayoutAction $obj */
        $obj = \Phpfox::with('layout_action')
            ->select()->where('action_id=?', 'blog_index_index')->first();

        $this->assertSame('layout_action', $obj->getModelId());
        $this->assertSame('blog_index_index', $obj->getId());
        $this->assertSame('default', $obj->getParentActionId());
        $this->assertSame('Blog Home', $obj->getActionName());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame('Blog landing page', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_action')
            ->delete()->where('action_id=?', 'blog_index_index')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_action')
            ->delete()->where('action_id=?', 'blog_index_index')->execute();
    }
}