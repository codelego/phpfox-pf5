<?php
namespace Neutron\Core\Model;

class AclValueTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclValue();

        $this->assertSame('acl_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getLevelId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());    }

    public function testParameters()
    {
        $obj = new AclValue();

        // set data
        $obj->setValueId('');
        $obj->setActionId('');
        $obj->setLevelId('');
        $obj->setName('');
        $obj->setValueActual('');
        // assert same data
        $this->assertSame('acl_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getLevelId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());    }

    public function testSave()
    {
        $obj = new AclValue();

        $obj->save();

        /** @var AclValue $obj */
        $obj = _model('acl_value')
            ->select()->where('value_id=?','')->first();

        $this->assertSame('acl_value', $obj->getModelId());
        $this->assertSame('', $obj->getValueId());
        $this->assertSame('', $obj->getActionId());
        $this->assertSame('', $obj->getLevelId());
        $this->assertSame('', $obj->getName());
        $this->assertSame('', $obj->getValueActual());    }

    public static function setUpBeforeClass()
    {
        _model('acl_value')
            ->delete()->where('value_id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_value')
            ->delete()->where('value_id=?','')->execute();
    }
}