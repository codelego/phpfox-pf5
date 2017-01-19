<?php
namespace Phpfox\Action;


class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $request = new Request();

        $params = ['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3'];

        $request->setHost('www.example.com');
        $request->setMethod('post');
        $request->setProtocol('https');
        $request->setUri('/path/to/any');


        $this->assertEquals('www.example.com', $request->getHost());
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('https', $request->getProtocol());
        $this->assertEquals('/path/to/any', $request->getUri());
        $this->assertTrue($request->isPost());
        $this->assertFalse($request->isGet());

        $this->assertEmpty($request->getParams());

        $request->setParams($params);

        $this->assertEquals($params, $request->getParams());

        $this->assertEquals('v1', $request->get('k1'));
        $this->assertEquals('v2', $request->get('k2'));
        $this->assertEquals('v3', $request->get('k3'));
        $this->assertEquals(null, $request->get('k4'));
        $this->assertEquals('v4', $request->get('k4', 'v4'));
        $this->assertEquals(null, $request->get('k4'));

        $request->addParams(['k3' => 'v3.', 'k4' => 'v4.']);

        $this->assertEquals('v3.', $request->get('k3'));
        $this->assertEquals('v4.', $request->get('k4'));

        $request->set('k5', 'v5');
        $this->assertEquals('v5', $request->get('k5'));
    }
}
