<?php

namespace Phpfox\Error;


class FormatAsListTest extends \PHPUnit_Framework_TestCase
{

    public function testFormatWithValidData()
    {
        $messages = new MessageContainer();
        $obj = new FormatAsList();
        $this->assertSame(true, $messages->isValid());
        $this->assertEmpty($obj->format($messages));
    }

    public function testFormatWithInvalidData()
    {
        $messages = new MessageContainer();
        $messages->add('name', 'invalid value');
        $obj = new FormatAsList();
        $this->assertSame(false, $messages->isValid());
        $this->assertNotEmpty($obj->format($messages));
    }
}
