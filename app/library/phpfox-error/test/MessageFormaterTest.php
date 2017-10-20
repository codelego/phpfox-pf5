<?php

namespace Phpfox\Error;


class MessageFormaterTest extends \PHPUnit_Framework_TestCase
{
    public function testAddErrors()
    {
        $messages = new MessageContainer();

        $messages->add('name', 'invalid name');

        $this->assertSame(false, $messages->isValid());

        return $messages;
    }

    /**
     * @param MessageContainer $messages
     *
     * @depends testAddErrors
     */
    public function testMakeByNotEmpty($messages)
    {
        $mn = new MessageFormater();

        $this->assertTrue($mn->make(null) instanceof MessageFormatInterface);
        $this->assertTrue($mn->make('ul') instanceof MessageFormatInterface);
        $this->assertTrue($mn->make('any') instanceof MessageFormatInterface);

        $this->assertNotEmpty($mn->format($messages, null));
        $this->assertNotEmpty($mn->format($messages, null));
        $this->assertNotEmpty($mn->format($messages, null));
    }

    public function testMakeByEmpty()
    {
        $messages = new MessageContainer();
        $mn = new MessageFormater();

        $this->assertSame('', $mn->format($messages, null));
        $this->assertSame('', $mn->format($messages, 'ul'));
        $this->assertSame('', $mn->format($messages, 'example'));
    }
}
