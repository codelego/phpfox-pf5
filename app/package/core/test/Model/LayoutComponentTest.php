<?php

namespace Neutron\Core\Model;

class LayoutComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutComponent(['component_id'    => 'blog.category',
                                    'component_name'  => 'Blog - Category',
                                    'component_class' => 'Neutron\\Blog\\Block\\CategoryComponent',
                                    'package_id'      => 'blog',
                                    'is_active'       => 1,
                                    'ordering'        => 1,
                                    'description'     => '',
        ]);

        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('blog.category', $obj->getComponentId());
        $this->assertSame('Blog - Category', $obj->getComponentName());
        $this->assertSame('Neutron\Blog\Block\CategoryComponent', $obj->getComponentClass());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutComponent();

        // set data
        $obj->setComponentId('blog.category');
        $obj->setComponentName('Blog - Category');
        $obj->setComponentClass('Neutron\Blog\Block\CategoryComponent');
        $obj->setPackageId('blog');
        $obj->setActive(1);
        $obj->setOrdering(1);
        $obj->setDescription('');
        // assert same data
        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('blog.category', $obj->getComponentId());
        $this->assertSame('Blog - Category', $obj->getComponentName());
        $this->assertSame('Neutron\Blog\Block\CategoryComponent', $obj->getComponentClass());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutComponent(['component_id'    => 'blog.category',
                                    'component_name'  => 'Blog - Category',
                                    'component_class' => 'Neutron\\Blog\\Block\\CategoryComponent',
                                    'package_id'      => 'blog',
                                    'is_active'       => 1,
                                    'ordering'        => 1,
                                    'description'     => '',
        ]);

        $obj->save();

        /** @var LayoutComponent $obj */
        $obj = \Phpfox::model('layout_component')
            ->select()->where('component_id=?', 'blog.category')->first();

        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('blog.category', $obj->getComponentId());
        $this->assertSame('Blog - Category', $obj->getComponentName());
        $this->assertSame('Neutron\Blog\Block\CategoryComponent', $obj->getComponentClass());
        $this->assertSame('blog', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('layout_component')
            ->delete()->where('component_id=?', 'blog.category')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('layout_component')
            ->delete()->where('component_id=?', 'blog.category')->execute();
    }
}