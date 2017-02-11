<?php

namespace Phpfox\Action;

class AjaxResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $response = new Response();

        $response->setData(['key1' => 'value1']);

        $obj = new AjaxResponse();

        $this->assertSame('{"key1":"value1"}', $obj->run($response));
    }
}