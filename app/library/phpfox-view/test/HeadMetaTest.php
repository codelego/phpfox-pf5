<?php

namespace Phpfox\View;


class HeadMetaTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new HeadMeta();

        $this->assertEmpty($obj->getHtml());

        $obj->add('charset', ['charset' => 'utf-8']);
        $obj->add('viewport',
            ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
        $obj->add('viewport', [
            'name'    => 'viewport',
            'content' => 'width=device-width, initial-scale=1',
        ]);

        $this->assertNotFalse('<meta charset="utf-8"/>',
            $obj->getHtml());
        $this->assertNotFalse('<meta http-equiv="X-UA-Compatible" content="IE=edge" />',
            $obj->getHtml());
        $this->assertNotFalse('<meta name="viewport" content="width=device-width, initial-scale=1" />',
            $obj->getHtml());

        $obj->clear();

        $this->assertEmpty($obj->getHtml());
    }
}
