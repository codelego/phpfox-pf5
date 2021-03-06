<?php

namespace Neutron\Video\Model;

class VideoCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new VideoCategory(['category_id' => 1, 'is_active' => 1, 'name' => 'Film & Animation', 'description' => null,]);

        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Film & Animation', $obj->getName());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new VideoCategory();

        // set data
        $obj->setCategoryId(1);
        $obj->setActive(1);
        $obj->setName('Film & Animation');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Film & Animation', $obj->getName());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new VideoCategory(['category_id' => 1, 'is_active' => 1, 'name' => 'Film & Animation', 'description' => null,]);

        $obj->save();

        /** @var VideoCategory $obj */
        $obj = \Phpfox::model('video_category')
            ->select()->where('category_id=?', 1)->first();

        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Film & Animation', $obj->getName());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('video_category')
            ->delete()->where('category_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('video_category')
            ->delete()->where('category_id=?', 1)->execute();
    }
}