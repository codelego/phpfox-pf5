<?php

namespace Phpfox\Mvc;

class DispatchTest extends \PHPUnit_Framework_TestCase
{
    public function testDispatch()
    {
        \Phpfox::get('mvc.dispatch')->run();
    }
}
