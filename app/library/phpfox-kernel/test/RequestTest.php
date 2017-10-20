<?php

namespace Phpfox\Kernel;


class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $request = Request::factory([
            'host'     => 'www.example.com',
            'protocol' => 'https',
            'path'     => 'blog/post',
            'm1'       => 'v1',
            'method'   => 'post',
        ]);

        $this->assertSame('www.example.com', $request->getHost());
        $this->assertSame('www.example.com', $request->get('host'));
        $this->assertSame('https', $request->getProtocol());
        $this->assertSame('https', $request->get('protocol'));
        $this->assertSame('blog/post', $request->getPath());
        $this->assertSame('blog/post', $request->get('path'));

        $this->assertSame('v1', $request->get('m1'));
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('POST', $request->get('method'));
        $this->assertSame(true, $request->isPost());
        $this->assertSame(false, $request->isGet());

        $request->singleton();

        $this->assertSame($request, \Phpfox::get('request'));

    }

    public function testSetMethod()
    {
        $request = new Request();

        $params = ['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3'];

        $request->set('host', 'www.example.com');
        $request->set('method', 'post');
        $request->set('protocol', 'https');
        $request->set('path', '/path/to/any');


        $this->assertEquals('www.example.com', $request->getHost());
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('https', $request->getProtocol());
        $this->assertEquals('/path/to/any', $request->getPath());
        $this->assertTrue($request->isPost());
        $this->assertFalse($request->isGet());
    }

    public function testBase()
    {
        $request = new Request();

        $params = ['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3'];

        $request->setHost('www.example.com');
        $request->setMethod('post');
        $request->setProtocol('https');
        $request->setPath('/path/to/any');


        $this->assertEquals('www.example.com', $request->getHost());
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('https', $request->getProtocol());
        $this->assertEquals('/path/to/any', $request->getPath());
        $this->assertTrue($request->isPost());
        $this->assertFalse($request->isGet());

        $this->assertEmpty($request->all());

        $request->put($params);

        $this->assertEquals($params, $request->all());

        $this->assertEquals('v1', $request->get('k1'));
        $this->assertEquals('v2', $request->get('k2'));
        $this->assertEquals('v3', $request->get('k3'));
        $this->assertEquals(null, $request->get('k4'));
        $this->assertEquals('v4', $request->get('k4', 'v4'));
        $this->assertEquals(null, $request->get('k4'));

        $request->add(['k3' => 'v3.', 'k4' => 'v4.']);

        $this->assertEquals('v3.', $request->get('k3'));
        $this->assertEquals('v4.', $request->get('k4'));

        $request->set('k5', 'v5');
        $this->assertEquals('v5', $request->get('k5'));
    }
}
