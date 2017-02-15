<?php

namespace Phpfox\Messaging;


class SampleJobHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testHandle()
    {
        $obj = new SampleJobHandler('', '', '',
            []);

        $obj->handle();

        $this->assertFalse(false);
    }
}
