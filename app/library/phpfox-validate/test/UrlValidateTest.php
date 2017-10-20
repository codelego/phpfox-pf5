<?php

namespace Phpfox\Validate;


class UrlValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new UrlValidate();

        $this->assertTrue($obj->isValid('https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.videos.list'));
        $this->assertTrue($obj->isValid('http://tuoitre.com'));
        $this->assertFalse($obj->isValid('tuoitre.com'));
    }
}
