<?php

namespace Phpfox\Error;

class MessageContainerTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $obj = new MessageContainer();

        $this->assertSame([], $obj->all());
        $this->assertSame(true, $obj->isValid());
        $this->assertSame('', $obj->getHtml());
    }

    public function testAddMessage()
    {
        $obj = new MessageContainer();

        $obj->add('name', 'invalid name');

        $this->assertSame(['name' => ['invalid name']], $obj->all());
        $this->assertSame(['invalid name'], $obj->get('name'));
        $this->assertSame(true, $obj->has('name'));
        $this->assertSame(false, $obj->isValid());
        $this->assertNotEmpty($obj->getHtml());

        return $obj;
    }

    /**
     * @param MessageContainer $obj
     *
     * @depends  testAddMessage
     */
    public function testFlushMessage($obj)
    {

        $obj->flush();

        $this->assertSame([], $obj->all());
        $this->assertSame([], $obj->get('name'));
        $this->assertSame(false, $obj->has('name'));
    }

    /**
     * @param MessageContainer $obj
     *
     * @depends  testAddMessage
     */
    public function testDeleteMessage($obj)
    {
        $obj->delete('name');

        $this->assertSame([], $obj->all());
        $this->assertSame([], $obj->get('name'));
        $this->assertSame(false, $obj->has('name'));
    }
}
