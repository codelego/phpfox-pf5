<?php

namespace Phpfox\Support;

class AjaxResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $response = new Response();

        $response->setData(['key1' => 'value1']);

        $obj = new JsonResponse();

        $this->assertSame('{"key1":"value1"}', $obj->run($response));
    }
}
