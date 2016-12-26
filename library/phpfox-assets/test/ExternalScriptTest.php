<?php

namespace Phpfox\Assets;


class ExternalScriptTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ExternalScript();

        $this->assertEmpty($obj->getHtml());


        $obj->add(null, '//www.example.com/script1.js');
        $this->assertNotFalse(strpos($obj->getHtml(),
            '<script type="text/javascript" src="//www.example.com/script1.js"></script>'),$obj->getHtml());

        $obj->add(null, '//www.example.com/script2.js');
        $this->assertNotFalse(strpos($obj->getHtml(),
            '<script type="text/javascript" src="//www.example.com/script2.js"></script>'),$obj->getHtml());

        $obj->clear();
        $this->assertEmpty($obj->getHtml());
    }
}
