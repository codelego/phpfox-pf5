<?php

namespace Phpfox\Kernel;


class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $_SERVER = [
            'SCRIPT_FILENAME' => 'index.php',
            'SCRIPT_NAME'     => 'index.php',
            'DOCUMENT_ROOT'   => '',
            'SERVER_PROTOCOL' => 'https',
            'PATH_INFO'       => '',
            'REDIRECT_URL'    => '/path/index.php/to/any',
            'REQUEST_METHOD'  => 'GET',
            'HTTP_HOST'       => 'www.example.com',
        ];
        $request = (new RequestFactory())->factory();

        $this->assertTrue($request instanceof Request);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/to/any', $request->getPath());
        $this->assertEquals('http://', $request->getProtocol());
        $this->assertEquals('www.example.com', $request->getHost());

    }
}
