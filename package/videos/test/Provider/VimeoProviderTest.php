<?php

namespace Neutron\Video\Provider;

class VimeoProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $provider = new VimeoProvider();
        $this->assertEquals('vimeo.com', $provider->getProviderName());
        $this->assertEquals('vimeo', $provider->getProviderId());
    }

    public function testParser()
    {

        $provider = new VimeoProvider();

        $url = 'https://vimeo.com/198108357';

        $content = $provider->parseFromUrl($url);

        $this->assertEquals('vimeo.com', $content->getProviderName());
        $this->assertEquals('vimeo', $content->getProviderId());
        $this->assertEquals('198108357', $content->getVideoCode());
    }

    public function testEmbedCode()
    {
        $provider = new VimeoProvider();
        $this->assertNotEmpty($provider->getEmbedCode('198108357', []));
    }
}
