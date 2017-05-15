<?php

namespace Neutron\Core\Model;

class CoreMenuTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreMenu([
            'id'          => 1,
            'ordering'  => 1,
            'menu'        => 'admin',
            'name'        => 'dashboard',
            'parent_name' => null,
            'package_id'  => 'core',
            'label'       => 'Dashboard',
            'route'       => 'admin',
            'params'      => '',
            'extra'       => '[]',
            'acl'         => null,
            'event'       => '',
            'plugin'      => null,
            'is_active'   => 1,
            'is_custom'   => 0,
            'type'        => 'route',
        ]);

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenu());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getAcl());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame('', $obj->getPlugin());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getType());
    }

    public function testParameters()
    {
        $obj = new CoreMenu();

        // set data
        $obj->setId(1);
        $obj->setOrdering(1);
        $obj->setMenu('admin');
        $obj->setName('dashboard');
        $obj->setParentName('');
        $obj->setPackageId('core');
        $obj->setLabel('Dashboard');
        $obj->setRoute('admin');
        $obj->setParams('');
        $obj->setExtra('[]');
        $obj->setAcl('');
        $obj->setEvent('');
        $obj->setPlugin('');
        $obj->setActive(1);
        $obj->setCustom(0);
        $obj->setType('route');
        // assert same data
        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenu());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getAcl());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame('', $obj->getPlugin());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getType());
    }

    public function testSave()
    {
        $obj = new CoreMenu([
            'id'          => 1,
            'ordering'  => 1,
            'menu'        => 'admin',
            'name'        => 'dashboard',
            'parent_name' => null,
            'package_id'  => 'core',
            'label'       => 'Dashboard',
            'route'       => 'admin',
            'params'      => '',
            'extra'       => '[]',
            'acl'         => null,
            'event'       => '',
            'plugin'      => null,
            'is_active'   => 1,
            'is_custom'   => 0,
            'type'        => 'route',
        ]);

        $obj->save();

        /** @var CoreMenu $obj */
        $obj = _model('core_menu')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('core_menu', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('admin', $obj->getMenu());
        $this->assertSame('dashboard', $obj->getName());
        $this->assertSame('', $obj->getParentName());
        $this->assertSame('core', $obj->getPackageId());
        $this->assertSame('Dashboard', $obj->getLabel());
        $this->assertSame('admin', $obj->getRoute());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('[]', $obj->getExtra());
        $this->assertSame('', $obj->getAcl());
        $this->assertSame('', $obj->getEvent());
        $this->assertSame('', $obj->getPlugin());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isCustom());
        $this->assertSame('route', $obj->getType());
    }

    public static function setUpBeforeClass()
    {
        _model('core_menu')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_menu')
            ->delete()->where('id=?', 1)->execute();
    }
}