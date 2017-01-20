<?php

namespace Neutron\Video\Provider;


class ParseResultTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $pr = new ParseResult();
        $pr->setProviderId('youtube');
        $pr->setProviderName('youtube.com');
        $pr->setTitle('youtube video title');
        $pr->setDescription('youtube video description');
        $pr->setVideoDuration('1000');
        $pr->setDefinition('hq');
        $pr->setThumbMode('xs');
        $pr->setVideoCode('5vZ4lCKv1ik');
        $pr->setThumbnailUrl('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg');
        $pr->setThumbnailSmallUrl('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg');
        $pr->setDimension('2d');

        $this->assertEquals('youtube', $pr->getProviderId());
        $this->assertEquals('youtube.com', $pr->getProviderName());
        $this->assertEquals('youtube.com', $pr->getProviderName());
        $this->assertEquals('youtube video title', $pr->getTitle());
        $this->assertEquals('youtube video description', $pr->getDescription());
        $this->assertEquals(1000, $pr->getVideoDuration());
        $this->assertEquals('hq', $pr->getDefinition());
        $this->assertEquals('xs', $pr->getThumbMode());
        $this->assertEquals('5vZ4lCKv1ik', $pr->getVideoCode());
        $this->assertEquals('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg',
            $pr->getThumbnailSmallUrl());
        $this->assertEquals('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg',
            $pr->getThumbnailUrl());

        $this->assertArrayHasKey('title', $pr->toArray());

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
            'dimension'           => '2d',
        ];
        $pr = new ParseResult();
        $pr->fromArray($data);

        $this->assertEquals('youtube', $pr->getProviderId());
        $this->assertEquals('youtube.com', $pr->getProviderName());
        $this->assertEquals('youtube.com', $pr->getProviderName());
        $this->assertEquals('youtube video title', $pr->getTitle());
        $this->assertEquals('youtube video description', $pr->getDescription());
        $this->assertEquals(1000, $pr->getVideoDuration());
        $this->assertEquals('hq', $pr->getDefinition());
        $this->assertEquals('xs', $pr->getThumbMode());
        $this->assertEquals('5vZ4lCKv1ik', $pr->getVideoCode());
        $this->assertEquals('https://i.ytimg.com/vi/5vZ4lCKv1ik/mqdefault.jpg',
            $pr->getThumbnailSmallUrl());
        $this->assertEquals('http://img.youtube.com/vi/5vZ4lCKv1ik/sddefault.jpg',
            $pr->getThumbnailUrl());

        $this->assertArrayHasKey('title', $pr->toArray());
    }
}
