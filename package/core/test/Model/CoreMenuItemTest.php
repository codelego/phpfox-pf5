<?php
namespace Neutron\Core\Model;

class CoreMenuItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreMenuItem(array (  'id' => 1,  'ordering' => 0,  'menu_id' => 'admin',  'name' => 'dashboard',  'parent_name' => '',  'package_id' => 'core',  'label' => 'Dashboard',  'href' => '',  'route' => 'admin',  'params' => '[]',  'extra' => '[]',  'permission' => NULL,  'event' => '',  'is_active' => 1,  'is_custom' => 0,  'item_type' => 'route',  'is_ajax' => 1,  'is_self' => 1,));

        $this->assertSame('core_menu_item', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('', $obj->getHref());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getPermission());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getItemType());
        $this->assertSame(1, $obj->isAjax());
        $this->assertSame(1, $obj->isSelf());    }

    public function testParameters()
    {
        $obj = new CoreMenuItem();

        // set data
        $obj->setId(1);
        $obj->setOrdering(0);
        $obj->setMenuId('admin');
        $obj->setName('dashboard');
        $obj->setParentName('');
        $obj->setPackageId('core');
        $obj->setLabel('Dashboard');
        $obj->setHref('');
        $obj->setRoute('admin');
        $obj->setParams('[]');
        $obj->setExtra('[]');
        $obj->setPermission('');
        $obj->setEvent('');
        $obj->setActive(1);
        $obj->setCustom(0);
        $obj->setItemType('route');
        $obj->setAjax(1);
        $obj->setSelf(1);
        // assert same data
        $this->assertSame('core_menu_item', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('', $obj->getHref());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getPermission());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getItemType());
        $this->assertSame(1, $obj->isAjax());
        $this->assertSame(1, $obj->isSelf());    }

    public function testSave()
    {
        $obj = new CoreMenuItem(array (  'id' => 1,  'ordering' => 0,  'menu_id' => 'admin',  'name' => 'dashboard',  'parent_name' => '',  'package_id' => 'core',  'label' => 'Dashboard',  'href' => '',  'route' => 'admin',  'params' => '[]',  'extra' => '[]',  'permission' => NULL,  'event' => '',  'is_active' => 1,  'is_custom' => 0,  'item_type' => 'route',  'is_ajax' => 1,  'is_self' => 1,));

        $obj->save();

        /** @var CoreMenuItem $obj */
        $obj = _model('core_menu_item')
            ->select()->where('id=?',1)->first();

        $this->assertSame('core_menu_item', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(0, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenuId());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('', $obj->getHref());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getPermission());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getItemType());
        $this->assertSame(1, $obj->isAjax());
        $this->assertSame(1, $obj->isSelf());    }

    public static function setUpBeforeClass()
    {
        _model('core_menu_item')
            ->delete()->where('id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_menu_item')
            ->delete()->where('id=?',1)->execute();
    }
}