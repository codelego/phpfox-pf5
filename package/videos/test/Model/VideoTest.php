<?php
namespace Neutron\Video\Model;


class VideoTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $obj = new Video();

        $this->assertEquals('video', $obj->getModelId());

        $obj->setActive(true);
        $this->assertEquals(1, $obj->isActive());
        $obj->setActive(false);
        $this->assertEquals(0, $obj->isActive());
        $obj->setActive(null);
        $this->assertEquals(0, $obj->isActive());

        $obj->setApproved(true);
        $this->assertEquals(1, $obj->isApproved());
        $obj->setApproved(false);
        $this->assertEquals(0, $obj->isApproved());
        $obj->setApproved(null);
        $this->assertEquals(0, $obj->isApproved());

        $obj->setName('[example video name]');
        $this->assertEquals('[example video name]', $obj->getName());
        $this->assertEquals('[example video name]', $obj->getTitle());
        $obj->setName(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $this->assertSame(null, $obj->getId());
        $this->assertSame(null, $obj->getVideoId());

        $obj->setCreated('2016-10-10 0):00:00');
        $this->assertEquals('2016-10-10 0):00:00', $obj->getCreated());
        $obj->setCreated('');
        $this->assertEquals('', $obj->getCreated());
        $obj->setCreated('');
        $this->assertEquals('', $obj->getCreated());

        $obj->setUserId(100);
        $this->assertSame(100, $obj->getUserId());

        $obj->setCategoryId(101);
        $this->assertSame(101, $obj->getCategoryId());

        $obj->setPosterId(103);
        $this->assertSame(103, $obj->getPosterId());

        $obj->setPosterType('[any string]');
        $this->assertSame('[any string]', $obj->getPosterType());

        $obj->setParentId(104);
        $this->assertSame(104, $obj->getParentId());

        $obj->setParentType('[any parent type string]');
        $this->assertSame('[any parent type string]', $obj->getParentType());

        $obj->setProviderId('[any provider id]');
        $this->assertSame('[any provider id]', $obj->getProviderId());

        $obj->setDescription('[example video description]');
        $this->assertEquals('[example video description]',
            $obj->getDescription());
    }

    public function testCURD()
    {
        $data = [
            'title'       => '[example video title]',
            'user_id'     => 2,
            'category_id' => 1,
            'created'     => '2016-10-10 00:11:00',
            'is_active'   => 1,
            'is_approved' => 0,
            'provider_id' => 'youtube',
            'description' => '[example video description]',
            'parent_id'   => 1,
            'parent_type' => 'user',
            'poster_id' => 1,
            'poster_type' => 'user',
        ];

        $obj = new Video($data);

        $obj->save();

        /** @var Video $video */
        $video = \Phpfox::get('db')
            ->select('*')
            ->from(':video')
            ->where('video_id=?', $obj->getId())
            ->setPrototype(Video::class)
            ->first();

        $this->assertEquals('[example video title]', $video->getTitle());
        $this->assertEquals('[example video title]', $video->getName());
        $this->assertEquals('2', $video->getUserId());
        $this->assertEquals('1', $video->getCategoryId());
        $this->assertEquals('2016-10-10 00:11:00', $video->getCreated());
        $this->assertEquals('1', $video->isActive());
        $this->assertEquals('0', $video->isApproved());
        $this->assertEquals('youtube', $video->getProviderId());
        $this->assertEquals('[example video description]',
            $video->getDescription());

        $video->delete();

        $video = \Phpfox::get('db')
            ->select('*')
            ->from(':video')
            ->where('video_id=?', $obj->getId())
            ->setPrototype(Video::class)
            ->first();

        $this->assertNull($video);
    }

}
