<?php

namespace Phpfox\View;


class HeadKeywordTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new HeadKeyword();

        $this->assertEmpty($obj->getHtml());

        $obj->set('word1');
        $obj->add('word2');

        $this->assertNotFalse(strpos($obj->getHtml(), 'word1'));
        $this->assertNotFalse(strpos($obj->getHtml(), 'word2'));

        $obj->clear();
        $this->assertEmpty($obj->getHtml());
    }
}
