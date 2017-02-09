<?php

namespace Neutron\Video\Model;


class VideoCategoryTest extends \PHPUnit_Framework_TestCase
{

    public function testParameters()
    {
        $obj = new VideoCategory();

        $this->assertEquals('video_category', $obj->getModelId());

        $obj->setName('[example category name]');
        $this->assertEquals('[example category name]', $obj->getName());
        $this->assertEquals('[example category name]', $obj->getTitle());

        $obj->setName(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $obj->setTitle('[example category name]');
        $this->assertEquals('[example category name]', $obj->getName());
        $this->assertEquals('[example category name]', $obj->getTitle());

        $obj->setDescription('[example category description]');
        $this->assertEquals('[example category description]',
            $obj->getDescription());
        $this->assertEquals('[example category description]',
            $obj->getDescription());

        $obj->setDescription(null);
        $this->assertEquals('', $obj->getDescription());

        $obj->setTitle(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $obj->setActive(true);
        $this->assertEquals('1', $obj->isActive());
        $obj->setActive(false);
        $this->assertEquals('0', $obj->isActive());
        $obj->setActive(null);
        $this->assertEquals('0', $obj->isActive());
    }

    public function testSave()
    {
        $obj = new VideoCategory([
            'name'        => '[example category name]',
            'description' => '[example description]',
            'is_active'   => 1,
        ]);

        $obj->save();

        /** @var VideoCategory $entry */
        $entry = \Phpfox::with('video_category')
            ->select()
            ->where('category_id=?', $obj->getId())
            ->setPrototype(VideoCategory::class)
            ->first();


        $this->assertEquals('[example category name]', $entry->getTitle());
        $this->assertEquals('[example category name]', $entry->getName());
        $this->assertEquals('1', $entry->isActive());
        $this->assertEquals('[example description]', $entry->getDescription());

        $entry->delete();

        /** @var VideoCategory $entry */
        $entry = \Phpfox::with('video_category')
            ->select()
            ->where('category_id=?', $obj->getId())
            ->setPrototype(VideoCategory::class)
            ->first();

        $this->assertEmpty($entry);
    }
}
