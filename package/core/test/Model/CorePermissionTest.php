<?php

namespace Neutron\Core\Model;

class CorePermissionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CorePermission();

        $this->assertSame('core_permission', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getGroupName());
        $this->assertSame('', $obj->getActionName());
        $this->assertSame('', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new CorePermission();

        // set data
        $obj->setId('');
        $obj->setRoleId('');
        $obj->setGroupName('');
        $obj->setActionName('');
        $obj->setParams('');
        // assert same data
        $this->assertSame('core_permission', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getGroupName());
        $this->assertSame('', $obj->getActionName());
        $this->assertSame('', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new CorePermission();

        $obj->save();

        /** @var CorePermission $obj */
        $obj = _model('core_permission')
            ->select()->where('id=?', '')->first();

        $this->assertSame('core_permission', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getGroupName());
        $this->assertSame('', $obj->getActionName());
        $this->assertSame('', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        _model('core_permission')
            ->delete()->where('id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_permission')
            ->delete()->where('id=?', '')->execute();
    }
}