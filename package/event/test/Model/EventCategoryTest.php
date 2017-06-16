<?php
namespace Neutron\Event\Model;

class EventCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new EventCategory(array (  'category_id' => 12,  'is_active' => 1,  'name' => '[example name]',  'description' => '[description]',));

        $this->assertSame('event_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new EventCategory();

        // set data
        $obj->setCategoryId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');
        // assert same data
        $this->assertSame('event_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new EventCategory(array (  'category_id' => 12,  'is_active' => 1,  'name' => '[example name]',  'description' => '[description]',));

        $obj->save();

        /** @var EventCategory $obj */
        $obj = _model('event_category')
            ->select()->where('category_id=?',12)->first();

        $this->assertSame('event_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('event_category')
            ->delete()->where('category_id=?',12)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('event_category')
            ->delete()->where('category_id=?',12)->execute();
    }
}