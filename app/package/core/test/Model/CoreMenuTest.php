<?php

namespace Neutron\Core\Model;

class CoreMenuTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreMenu(['menu_id' => 'admin', 'menu_name' => 'Admin', 'package_id' => 'core', 'ordering' => 2, 'is_admin' => 1, 'is_system' => 1, 'is_custom' => 0, 'description' => null,]);

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new CoreMenu();

        // set data
        $obj->setMenuId('admin');
        $obj->setMenuName('Admin');
        $obj->setPackageId('core');
        $obj->setOrdering(2);
        $obj->setAdmin(1);
        $obj->setSystem(1);
        $obj->setCustom(0);
        $obj->setDescription('');
        // assert same data
        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new CoreMenu(['menu_id' => 'admin', 'menu_name' => 'Admin', 'package_id' => 'core', 'ordering' => 2, 'is_admin' => 1, 'is_system' => 1, 'is_custom' => 0, 'description' => null,]);

        $obj->save();

        /** @var CoreMenu $obj */
        $obj = \Phpfox::model('core_menu')
            ->select()->where('menu_id=?', 'admin')->first();

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isSystem());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('core_menu')
            ->delete()->where('menu_id=?', 'admin')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('core_menu')
            ->delete()->where('menu_id=?', 'admin')->execute();
    }
}