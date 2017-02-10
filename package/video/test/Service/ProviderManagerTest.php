<?php

namespace Neutron\Video\Service;


use Neutron\Video\Provider\FacebookProvider;
use Neutron\Video\Provider\UploadProvider;
use Neutron\Video\Provider\VimeoProvider;
use Neutron\Video\Provider\YoutubeProvider;

class ProviderManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $mn = new ProviderManager();
        $all = $mn->getClasses();

        $this->assertArrayHasKey('youtube', $all);
        $this->assertArrayHasKey('facebook', $all);
        $this->assertArrayHasKey('vimeo', $all);
        $this->assertArrayHasKey('upload', $all);
        $this->assertArrayNotHasKey('no-key', $all);


    }

    public function testGet()
    {
        $mn = new ProviderManager();

        $this->assertTrue($mn->get('youtube') instanceof YoutubeProvider);
        $this->assertTrue($mn->get('facebook') instanceof FacebookProvider);
        $this->assertTrue($mn->get('vimeo') instanceof VimeoProvider);
        $this->assertTrue($mn->get('upload') instanceof UploadProvider);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Oops! video provider
     */
    public function testGetException()
    {
        $mn = new ProviderManager();

        $mn->get('no-key');
    }
}
