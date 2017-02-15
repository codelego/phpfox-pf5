<?php

namespace Neutron\Video\Service;


use Neutron\Video\Provider\VimeoProvider;
use Neutron\Video\Provider\YoutubeProvider;

class VideoManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testParseYoutube()
    {

        $youtube = new YoutubeProvider();

        $this->assertEquals('lEtts9YNUzM', $youtube->extractCode(
            $url = 'https://www.youtube.com/watch?v=lEtts9YNUzM'));

        $mn = new ProviderManager();

        /** @var YoutubeProvider $obj */
        $obj = $mn->get('youtube');
        $obj->setApiKey('AIzaSyD6pjdlJ-fzfL6FwIoznJ8lniANHyQPcI4');

        $url = 'https://www.youtube.com/watch?v=lEtts9YNUzM';

        $result = $mn->parseFromUrl($url);

        $this->assertNotEmpty($result);
        $this->assertEquals('youtube', $result->getProviderId());
    }

    public function testParseVimeo()
    {

        $mn = new ProviderManager();

        /** @var VimeoProvider $obj */
        $obj = $mn->get('vimeo');

        $url = 'https://vimeo.com/198108357';

        $result = $obj->parseFromUrl($url);

        $this->assertNotEmpty($result);
        $this->assertEquals('vimeo', $result->getProviderId());
    }

    /**
     * @expectedException \Neutron\Video\Provider\ParseException
     * @expectedExceptionMessage
     */
    public function testParseFacebook()
    {

        $mn = new ProviderManager();

        $url
            = 'https://www.facebook.com/hocthuthuatexcel/video/782531485242661';

        $result = $mn->parseFromUrl($url);

        $this->assertNotEmpty($result);
        $this->assertEquals('facebook', $result->getProviderId());
    }

    /**
     * @expectedException \Neutron\Video\Provider\ParseException
     */
    public function testParseFailure()
    {
        $mn = new ProviderManager();
        $mn->parseFromUrl('http://nonevideo.com');
    }


}
