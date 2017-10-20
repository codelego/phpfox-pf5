<?php

namespace Phpfox\View;


class StaticHtmlTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new StaticHtml();

        $this->assertEmpty($obj->getHtml());

        $obj->add('value 1');
        $obj->add('value 2');

        $this->assertNotFalse(strpos($obj->getHtml(), 'value 1'));
        $this->assertNotFalse(strpos($obj->getHtml(), 'value 2'));

        $obj->clear();

        $this->assertEmpty($obj->getHtml());

    }
}
