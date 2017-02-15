<?php

namespace Phpfox\Payments;


class GatewayManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testFilterByWithCondition()
    {
        $obj = new GatewayManager();

        $this->assertEmpty($obj->filterBy(['i' => 1]));
    }

    public function testFilterByEmpty()
    {
        $obj = new GatewayManager();

        $this->assertEmpty($obj->filterBy([]));
    }
}
