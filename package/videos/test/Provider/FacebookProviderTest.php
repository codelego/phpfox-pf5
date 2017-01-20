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

    public function testParser()
    {

        $provider = new FacebookProvider();

        $url
            = 'https://www.facebook.com/hocthuthuatexcel/videos/782531485242661/?hc_ref=NEWSFEED';

        $content = $provider->parseFromUrl($url);

        $this->assertEquals('facebook.com', $content->getProviderName());
        $this->assertEquals('facebook', $content->getProviderId());
        $this->assertEquals('782531485242661', $content->getVideoCode());
    }
}
