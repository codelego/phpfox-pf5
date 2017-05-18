<?php

namespace Phpfox\View;


class HeadLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testLink()
    {
        $obj = new HeadLink();

        $this->assertEmpty($obj->getHtml());

        $obj->add([
            'rel'  => 'atom+xml',
            'href' => '//www.example.com/atom+xml',
        ]);

        $obj->add([
            'rel'  => 'atom+rss',
            'href' => '//www.example.com/atom+rss',
        ]);

        $this->assertNotFalse(strpos($obj->getHtml(),
            '<link rel="atom+xml" href="//www.example.com/atom+xml" />'));
        $this->assertNotFalse(strpos($obj->getHtml(),
            '<link rel="atom+rss" href="//www.example.com/atom+rss" />'));

        $obj->clear();

        $this->assertEmpty($obj->getHtml());
    }
}
