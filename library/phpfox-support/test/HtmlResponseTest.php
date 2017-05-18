<?php

namespace Phpfox\Support;


use Phpfox\View\ViewModel;

class HtmlResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $response = new Response();
        $response->setData(new ViewModel('test/temp'));

        $obj = new HtmlResponse();

        $this->assertNotEmpty($obj->run($response));
    }
}
