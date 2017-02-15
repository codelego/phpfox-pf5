<?php

namespace Neutron\Video\Provider;


class FacebookProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $provider = new FacebookProvider();
        $this->assertEquals('facebook.com', $provider->getProviderName());
        $this->assertEquals('facebook', $provider->getProviderId());
    }

    /**
     * @expectedException \Exception
     */
    public function testParser()
    {

        $provider = new FacebookProvider();

        $url
            = 'https://www.facebook.com/hocthuthuatexcel/video/782531485242661';

        $content = $provider->parseFromUrl($url);

        $this->assertEquals('facebook.com', $content->getProviderName());
        $this->assertEquals('facebook', $content->getProviderId());
        $this->assertEquals('782531485242661', $content->getVideoCode());
    }

    public function testEmbedCode()
    {
        $provider = new FacebookProvider();
        $this->assertNotEmpty($provider->getEmbedCode('782531485242661', []));
    }

    public function testExtractVideoByEmpty()
    {
        $mn = new FacebookProvider();

        $this->assertNotEmpty($mn->extractVideo([]));
    }

    /**
     * @return array
     */
    public function provideExtractVideoParams()
    {
        return [
            [null, null, null],
            ['', '', ''],
            ['', '', true],
            ['', '', false],
        ];
    }

    /**
     * @param $videoId
     * @param $code
     * @param $autoplay
     * @dataProvider  provideExtractVideoParams
     */
    public function testExtractVideoByVideoId($videoId, $code, $autoplay)
    {
        $mn = new FacebookProvider();

        $this->assertNotEmpty($mn->extractVideo([
            'video_id' => $videoId,
            'code'     => $code,
            'autoplay' => $autoplay,
        ]));
    }
}
