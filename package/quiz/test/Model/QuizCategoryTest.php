<?php

namespace Neutron\Quiz\Model;

class QuizCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new QuizCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $this->assertSame('quiz_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new QuizCategory();

        // set data
        $obj->setId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('quiz_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new QuizCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var QuizCategory $obj */
        $obj = \Phpfox::with('quiz_category')
            ->select()->where('category_id=?', 12)->first();

        $this->assertSame('quiz_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('quiz_category')
            ->delete()->where('category_id=?', 12)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('quiz_category')
            ->delete()->where('category_id=?', 12)->execute();
    }
}