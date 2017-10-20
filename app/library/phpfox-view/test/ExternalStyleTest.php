<?php

namespace Phpfox\View;


class ExternalStyleTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new ExternalStyle();

        $this->assertEmpty($obj->getHtml());

        $obj->add(null, '//www.example.com/style1.css');
        $this->assertNotFalse(strpos($obj->getHtml(),
            '<link type="text/css" rel="stylesheet" href="//www.example.com/style1.css"/>'));


        $obj->add(null, '//www.example.com/style2.css');
        $this->assertNotFalse(strpos($obj->getHtml(),
            '<link type="text/css" rel="stylesheet" href="//www.example.com/style2.css"/>'));

        $obj->clear();
        $this->assertEmpty($obj->getHtml());


    }

}
