<?php

namespace Neutron\Photo\Model;

class PhotoCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PhotoCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new PhotoCategory();

        // set data
        $obj->setId(12);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new PhotoCategory([
            'category_id' => 12,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var PhotoCategory $obj */
        $obj = \Phpfox::with('photo_category')
            ->select()->where('category_id=?', 12)->first();

        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(12, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('photo_category')
            ->delete()->where('category_id=?', 12)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('photo_category')
            ->delete()->where('category_id=?', 12)->execute();
    }
}