<?php

namespace Neutron\Poll\Model;

class PollCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PollCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $this->assertSame('poll_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new PollCategory();

        // set data
        $obj->setId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('poll_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new PollCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var PollCategory $obj */
        $obj = _with('poll_category')
            ->select()->where('category_id=?', 12)->first();

        $this->assertSame('poll_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _with('poll_category')
            ->delete()->where('category_id=?', 12)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('poll_category')
            ->delete()->where('category_id=?', 12)->execute();
    }
}