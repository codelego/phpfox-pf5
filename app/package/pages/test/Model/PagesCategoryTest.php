<?php

namespace Neutron\Pages\Model;

class PagesCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PagesCategory(['category_id' => 12, 'is_active' => 1, 'name' => '[example name]', 'description' => '[description]',]);

        $this->assertSame('pages_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new PagesCategory();

        // set data
        $obj->setCategoryId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');
        // assert same data
        $this->assertSame('pages_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new PagesCategory(['category_id' => 12, 'is_active' => 1, 'name' => '[example name]', 'description' => '[description]',]);

        $obj->save();

        /** @var PagesCategory $obj */
        $obj = \Phpfox::model('pages_category')
            ->select()->where('category_id=?', 12)->first();

        $this->assertSame('pages_category', $obj->getModelId());
        $this->assertSame(12, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('pages_category')
            ->delete()->where('category_id=?', 12)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('pages_category')
            ->delete()->where('category_id=?', 12)->execute();
    }
}