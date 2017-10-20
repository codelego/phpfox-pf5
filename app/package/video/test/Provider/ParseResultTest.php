<?php

namespace Neutron\Video\Provider;


class ParseResultTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ParseResult();
        $obj->setProviderId('youtube');
        $obj->setProviderName('youtube.com');
        $obj->setTitle('youtube video title');
        $obj->setDescription('youtube video description');
        $obj->setVideoDuration('1000');
        $obj->setDefinition('hq');
        $obj->setThumbMode('xs');
        $obj->setVideoCode('5vZ4lCKv1ik');
        $obj->setDimension('2d');
        $obj->setThumbnailUrl('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg');
        $obj->setThumbnailSmallUrl('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg');
        $obj->setDimension('2d');
        $obj->setOriginUrl('https://youtbe.be/abc?w=5vZ4lCKv1ik');

        $this->assertEquals('youtube', $obj->getProviderId());
        $this->assertEquals('youtube.com', $obj->getProviderName());
        $this->assertEquals('youtube.com', $obj->getProviderName());
        $this->assertEquals('youtube video title', $obj->getTitle());
        $this->assertEquals('youtube video description',
            $obj->getDescription());
        $this->assertEquals(1000, $obj->getVideoDuration());
        $this->assertEquals('hq', $obj->getDefinition());
        $this->assertEquals('xs', $obj->getThumbMode());
        $this->assertEquals('5vZ4lCKv1ik', $obj->getVideoCode());
        $this->assertEquals('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg',
            $obj->getThumbnailSmallUrl());
        $this->assertEquals('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg',
            $obj->getThumbnailUrl());

        $this->assertEquals('https://youtbe.be/abc?w=5vZ4lCKv1ik',
            $obj->getOriginUrl());
        $this->assertEquals('2d', $obj->getDimension());

        $this->assertArrayHasKey('title', $obj->toArray());

    }

    public function testFromArray()
    {
        $data = [
            'provider_id'         => 'youtube',
            'provider_name'       => 'youtube.com',
            'title'               => 'youtube video title',
            'description'         => 'youtube video description',
            'video_duration'      => '1000',
            'definition'          => 'hq',
            'thumb_mode'          => 'xs',
            'video_code'          => '5vZ4lCKv1ik',
            'thumbnail_url'       => 'http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg',
            'thumbnail_small_url' => 'https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg',
            'origin_url'          => 'https://www.youtube.com/watch?v=5vZ4lCKv1ik',
            'dimension'           => '2d',
        ];
        $obj = new ParseResult();
        $obj->fromArray($data);

        $this->assertEquals('youtube', $obj->getProviderId());
        $this->assertEquals('youtube.com', $obj->getProviderName());
        $this->assertEquals('youtube.com', $obj->getProviderName());
        $this->assertEquals('youtube video title', $obj->getTitle());
        $this->assertEquals('youtube video description',
            $obj->getDescription());
        $this->assertEquals(1000, $obj->getVideoDuration());
        $this->assertEquals('hq', $obj->getDefinition());
        $this->assertEquals('xs', $obj->getThumbMode());
        $this->assertEquals('2d', $obj->getDimension());
        $this->assertEquals('5vZ4lCKv1ik', $obj->getVideoCode());
        $this->assertEquals('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg',
            $obj->getThumbnailSmallUrl());
        $this->assertEquals('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg',
            $obj->getThumbnailUrl());

        $this->assertEquals('https://www.youtube.com/watch?v=5vZ4lCKv1ik',
            $obj->getOriginUrl());

        $this->assertArrayHasKey('title', $obj->toArray());
    }
}
