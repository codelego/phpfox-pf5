<?php

namespace Phpfox\Support;


class ResponseTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $rp = new Response();

        $this->assertNull($rp->last());
        $this->assertNull($rp->first());
        $this->assertFalse($rp->contains(['value1', 'value3']));

    }

    public function testBase2()
    {
        $rp = new Response();

        $rp->push(['value1', 'value2']);

        $this->assertEquals(['value1', 'value2'], $rp->last());
        $this->assertEquals(['value1', 'value2'], $rp->first());
        $this->assertTrue($rp->contains(['value1', 'value2']));
        $this->assertFalse($rp->contains(['value1', 'value3']));

    }
}
