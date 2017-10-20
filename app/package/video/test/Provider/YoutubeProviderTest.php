<?php

namespace Neutron\Video\Provider;


class YoutubeProviderTest extends \PHPUnit_Framework_TestCase
{

    public function YoutubeProvider()
    {
        $provider = new YoutubeProvider();
        $this->assertEquals('youtube.com', $provider->getProviderName());
        $this->assertEquals('youtube', $provider->getProviderId());
    }

    public function testParser()
    {

        $provider = new YoutubeProvider();

        $this->assertNull($provider->getApiKey());

        $provider->setApiKey('AIzaSyD6pjdlJ-fzfL6FwIoznJ8lniANHyQPcI4');

        $url = 'https://www.youtube.com/watch?v=5vZ4lCKv1ik';

        $content = $provider->parseFromUrl($url);

        $this->assertEquals('youtube.com', $provider->getProviderName());

        $this->assertEquals('youtube.com', $content->getProviderName());
        $this->assertEquals('youtube', $content->getProviderId());
        $this->assertEquals('5vZ4lCKv1ik', $content->getVideoCode());
    }

    /**
     * @expectedException \Neutron\Video\Provider\ParseException
     */
    public function testEmptyKey()
    {
        $provider = new YoutubeProvider();
        $provider->setApiKey('');

        $url = 'https://www.youtube.com/watch?v=5vZ4lCKv1ik';
        $provider->parseFromUrl($url);
    }

    public function testEmbedCode()
    {
        $provider = new YoutubeProvider();
        $this->assertNotEmpty($provider->getEmbedCode('5vZ4lCKv1ik', []));
    }
}
