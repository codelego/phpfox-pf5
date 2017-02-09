<?php

namespace Neutron\Video\Service;


use Neutron\Video\Provider\FacebookProvider;
use Neutron\Video\Provider\VimeoProvider;
use Neutron\Video\Provider\YoutubeProvider;

class VideosTest extends \PHPUnit_Framework_TestCase
{
    public function testParseYoutube()
    {

        $mn = new Providers();

        /** @var YoutubeProvider $obj */
        $obj = $mn->get('youtube');
        $obj->setApiKey('AIzaSyD6pjdlJ-fzfL6FwIoznJ8lniANHyQPcI4');

        $url = 'https://www.youtube.com/watch?v=uetr8GocsuM';

        $result = $mn->parseFromUrl($url);

        $this->assertNotEmpty($result);
        $this->assertEquals('youtube', $result->getProviderId());
    }

    public function testParseVimeo()
    {

        $mn = new Providers();

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

        $mn = new Providers();

        /** @var FacebookProvider $obj */
        $obj = $mn->get('facebook');

        $obj->setAccessToken('');
        $url
            = 'https://www.facebook.com/hocthuthuatexcel/videos/782531485242661';

        $result = $mn->parseFromUrl($url);

        $this->assertNotEmpty($result);
        $this->assertEquals('facebook', $result->getProviderId());
    }

}
