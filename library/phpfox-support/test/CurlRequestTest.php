<?php

namespace Phpfox\Support;

class CurlRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $request = new CurlRequest([
            'url'  => 'http://localhost/test.php',
            'key1' => 'value1',
        ]);

        $this->assertTrue(is_resource($request->getStream()));

        $this->assertEquals('http://localhost/test.php',
            $request->get('url'));

        $this->assertEquals('value1', $request->get('key1'));

    }
}
