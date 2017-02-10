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
}
