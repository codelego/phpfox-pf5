<?php
namespace Neutron\Core\Model;

class AclLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclLevel(array (  'internal_id' => 1,  'level_id' => 1,  'level_type' => 'user',  'inherit_id' => 0,  'title' => 'Super',));

        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame('user', $obj->getLevelType());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());    }

    public function testParameters()
    {
        $obj = new AclLevel();

        // set data
        $obj->setInternalId(1);
        $obj->setLevelId(1);
        $obj->setLevelType('user');
        $obj->setInheritId(0);
        $obj->setTitle('Super');
        // assert same data
        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame('user', $obj->getLevelType());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());    }

    public function testSave()
    {
        $obj = new AclLevel(array (  'internal_id' => 1,  'level_id' => 1,  'level_type' => 'user',  'inherit_id' => 0,  'title' => 'Super',));

        $obj->save();

        /** @var AclLevel $obj */
        $obj = _model('acl_level')
            ->select()->where('internal_id=?',1)->first();

        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getInternalId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame('user', $obj->getLevelType());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());    }

    public static function setUpBeforeClass()
    {
        _model('acl_level')
            ->delete()->where('internal_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_level')
            ->delete()->where('internal_id=?',1)->execute();
    }
}