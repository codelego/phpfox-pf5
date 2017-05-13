<?php

namespace Neutron\Core\Model;

class AclSettingValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclSettingValue();

        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());
    }

    public function testParameters()
    {
        $obj = new AclSettingValue();

        // set data
        $obj->setValueId('');
        $obj->setActionId('');
        $obj->setRoleId('');
        $obj->setName('');
        $obj->setValueActual('');
        // assert same data
        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());
    }

    public function testSave()
    {
        $obj = new AclSettingValue();

        $obj->save();

        /** @var AclSettingValue $obj */
        $obj = _model('acl_setting_value')
            ->select()->where('value_id=?', '')->first();

        $this->assertSame('acl_setting_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getRoleId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());
    }

    public static function setUpBeforeClass()
    {
        _model('acl_setting_value')
            ->delete()->where('value_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_setting_value')
            ->delete()->where('value_id=?', '')->execute();
    }
}