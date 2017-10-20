<?php

namespace Phpfox\View;


class HeadTitleTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $mn = new HeadTitle();

        $this->assertEmpty($mn->getHtml());

        $mn->setSeparator('-');
        $this->assertEquals('-', $mn->getSeparator());

        $mn->set('example title string');

        $this->assertEquals('<title>example title string</title>',
            $mn->getHtml());

        $mn->add('suffix');

        $this->assertNotFalse('example title string-suffix', $mn->getHtml());

        $mn->clear();
        $this->assertEmpty($mn->getHtml());
    }
}
