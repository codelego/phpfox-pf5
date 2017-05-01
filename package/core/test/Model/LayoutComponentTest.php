<?php

namespace Neutron\Core\Model;

class LayoutComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutComponent(array (  'component_id' => 'core.action_content',  'component_name' => 'Action Content',  'component_class' => 'Neutron\\Core\\Block\\ActionContent',  'form_name' => 'none',  'package_id' => 'core',  'is_active' => 1,  'sort_order' => 1,  'description' => NULL,));

        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('core.action_content', $obj->getId());
        $this->assertSame('Action Content', $obj->getComponentName());
        $this->assertSame('Neutron\Core\Block\ActionContent', $obj->getComponentClass());
        $this->assertSame('none', $obj->getFormName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new LayoutComponent();

        // set data
        $obj->setId('core.action_content');
        $obj->setComponentName('Action Content');
        $obj->setComponentClass('Neutron\Core\Block\ActionContent');
        $obj->setFormName('none');
        $obj->setPackageId('core');
        $obj->setActive(1);
        $obj->setSortOrder(1);
        $obj->setDescription('');

        // assert same data
        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('core.action_content', $obj->getId());
        $this->assertSame('Action Content', $obj->getComponentName());
        $this->assertSame('Neutron\Core\Block\ActionContent', $obj->getComponentClass());
        $this->assertSame('none', $obj->getFormName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new LayoutComponent(array (  'component_id' => 'core.action_content',  'component_name' => 'Action Content',  'component_class' => 'Neutron\\Core\\Block\\ActionContent',  'form_name' => 'none',  'package_id' => 'core',  'is_active' => 1,  'sort_order' => 1,  'description' => NULL,));

        $obj->save();

        /** @var LayoutComponent $obj */
        $obj = \Phpfox::with('layout_component')
            ->select()->where('component_id=?','core.action_content')->first();

        $this->assertSame('layout_component', $obj->getModelId());
        $this->assertSame('core.action_content', $obj->getId());
        $this->assertSame('Action Content', $obj->getComponentName());
        $this->assertSame('Neutron\Core\Block\ActionContent', $obj->getComponentClass());
        $this->assertSame('none', $obj->getFormName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_component')
            ->delete()->where('component_id=?','core.action_content')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_component')
            ->delete()->where('component_id=?','core.action_content')->execute();
    }
}