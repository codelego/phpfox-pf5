<?php

namespace Phpfox\Action;


class ActionResponseFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $response = (new ActionResponseFactory())->factory();

        $this->assertTrue($response instanceof ActionResponse);

        $this->assertEquals(200, $response->getCode());
        $this->assertEmpty($response->getData());

        $response->setData('example');

        $this->assertEquals('example', $response->getData());

        $response->setCode('201');
        $this->assertEquals(201, $response->getCode());
    }
}
