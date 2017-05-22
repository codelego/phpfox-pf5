<?php
namespace Neutron\Core\Model;

class CoreMenuTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreMenu(array (  'menu_id' => 'admin',  'menu_name' => 'Admin',  'package_id' => 'core',  'ordering' => 2,  'is_admin' => 1,));

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());    }

    public function testParameters()
    {
        $obj = new CoreMenu();

        // set data
        $obj->setMenuId('admin');
        $obj->setMenuName('Admin');
        $obj->setPackageId('core');
        $obj->setOrdering(2);
        $obj->setAdmin(1);
        // assert same data
        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());    }

    public function testSave()
    {
        $obj = new CoreMenu(array (  'menu_id' => 'admin',  'menu_name' => 'Admin',  'package_id' => 'core',  'ordering' => 2,  'is_admin' => 1,));

        $obj->save();

        /** @var CoreMenu $obj */
        $obj = _model('core_menu')
            ->select()->where('menu_id=?','admin')->first();

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('Admin', $obj->getMenuName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isAdmin());    }

    public static function setUpBeforeClass()
    {
        _model('core_menu')
            ->delete()->where('menu_id=?','admin')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_menu')
            ->delete()->where('menu_id=?','admin')->execute();
    }
}