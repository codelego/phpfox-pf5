<?php
namespace Neutron\Pages\Model;

class PagesLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Default',  'item_count' => 0,  'is_core' => 0,));

        $this->assertSame('pages_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(0, $obj->isCore());    }

    public function testParameters()
    {
        $obj = new PagesLevel();

        // set data
        $obj->setLevelId(1);
        $obj->setInheritId(0);
        $obj->setTitle('Default');
        $obj->setItemCount(0);
        $obj->setCore(0);
        // assert same data
        $this->assertSame('pages_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(0, $obj->isCore());    }

    public function testSave()
    {
        $obj = new PagesLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Default',  'item_count' => 0,  'is_core' => 0,));

        $obj->save();

        /** @var PagesLevel $obj */
        $obj = _model('pages_level')
            ->select()->where('level_id=?',1)->first();

        $this->assertSame('pages_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Default', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(0, $obj->isCore());    }

    public static function setUpBeforeClass()
    {
        _model('pages_level')
            ->delete()->where('level_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('pages_level')
            ->delete()->where('level_id=?',1)->execute();
    }
}