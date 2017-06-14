<?php
namespace Neutron\Group\Model;

class GroupLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new GroupLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Default',  'item_count' => 0,  'is_core' => 1,));

        $this->assertSame('group_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());    }

    public function testParameters()
    {
        $obj = new GroupLevel();

        // set data
        $obj->setLevelId(1);
        $obj->setInheritId(0);
        $obj->setTitle('Default');
        $obj->setItemCount(0);
        $obj->setCore(1);
        // assert same data
        $this->assertSame('group_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());    }

    public function testSave()
    {
        $obj = new GroupLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Default',  'item_count' => 0,  'is_core' => 1,));

        $obj->save();

        /** @var GroupLevel $obj */
        $obj = _model('group_level')
            ->select()->where('level_id=?',1)->first();

        $this->assertSame('group_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());    }

    public static function setUpBeforeClass()
    {
        _model('group_level')
            ->delete()->where('level_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('group_level')
            ->delete()->where('level_id=?',1)->execute();
    }
}