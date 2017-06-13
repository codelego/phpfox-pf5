<?php

namespace Phpfox\I18n;


class DateFormaterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $fmt = new DateFormater('en');
        $content  = $fmt->format(time(), 'full');

        $this->assertNotEmpty($content);

        $content  = $fmt->format(time(), 'short');

        $this->assertNotEmpty($content);

        $content  = $fmt->format(time(), 'long');

        $this->assertNotEmpty($content);

        $content  = $fmt->format(time(), 'medium');

        $this->assertNotEmpty($content);
    }

    public function testFormat2()
    {
        $fmt = new DateFormater('en');
        $time  =  date('Y-m-d H:i:s');

        $content  = $fmt->format($time, 'full');


        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'short');

        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'long');

        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'medium');

        $this->assertNotEmpty($content);
    }

    public function testFormat3()
    {
        $fmt = new DateFormater('en');
        $time  =  '2012-10-10 00:00:00';

        $content  = $fmt->format($time, 'full');

        _dump($content);

        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'short');

        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'long');

        $this->assertNotEmpty($content);

        $content  = $fmt->format($time, 'medium');

        $this->assertNotEmpty($content);
    }
}
