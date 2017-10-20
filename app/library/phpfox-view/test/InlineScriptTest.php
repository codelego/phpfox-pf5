<?php

namespace Phpfox\View;


class InlineScriptTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new InlineScript();

        $this->assertEmpty($obj->getHtml());

        $obj->add('body{color:red;}');
        $obj->add('html{margin:0;}');
        $obj->prepend('div{margin:0;}');
        $obj->prepend('div{padding:0;}');

        $this->assertNotFalse(strpos($obj->getHtml(), 'body{color:red;}'));
        $this->assertNotFalse(strpos($obj->getHtml(), 'html{margin:0;}'));
        $this->assertNotFalse(strpos($obj->getHtml(), 'div{margin:0;}'));
        $this->assertNotFalse(strpos($obj->getHtml(), 'div{padding:0;}'));

        $obj->clear();

        $this->assertEmpty($obj->getHtml());

    }
}
