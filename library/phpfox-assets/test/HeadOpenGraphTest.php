<?php

namespace Phpfox\Assets;


class HeadOpenGraphTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new HeadOpenGraph();

        $this->assertEmpty($obj->getHtml());

        $obj->add('og:title', 'sample title');
        $obj->add('og:image', 'http://sample image url');


        $this->assertNotFalse(strpos($obj->getHtml(), '<meta property="og:title" content="sample title" />'));
        $this->assertNotFalse(strpos($obj->getHtml(), '<meta property="og:image" content="http://sample image url" />'));

        $obj->remove('og:title');
        $this->assertFalse(strpos($obj->getHtml(), '<meta property="og:title" content="sample title" />'));

        $obj->clear();

        $this->assertEmpty($obj->getHtml());
    }
}
