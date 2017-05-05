<?php

namespace Neutron\Video\Model;

class VideoCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new VideoCategory([
            'category_id' => 15,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[Example Description]',
        ]);

        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(15, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new VideoCategory();

        // set data
        $obj->setId(15);
        $obj->setActive(1);
        $obj->setName('[example name]');
        $obj->setDescription('[Example Description]');

        // assert same data
        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(15, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new VideoCategory([
            'category_id' => 15,
            'is_active'   => 1,
            'name'        => '[example name]',
            'description' => '[Example Description]',
        ]);

        $obj->save();

        /** @var VideoCategory $obj */
        $obj = _model('video_category')
            ->select()->where('category_id=?', 15)->first();

        $this->assertSame('video_category', $obj->getModelId());
        $this->assertSame(15, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example name]', $obj->getName());
        $this->assertSame('[Example Description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('video_category')
            ->delete()->where('category_id=?', 15)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('video_category')
            ->delete()->where('category_id=?', 15)->execute();
    }
}