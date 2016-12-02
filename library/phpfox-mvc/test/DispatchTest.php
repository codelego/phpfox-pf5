<?php

namespace Phpfox\Mvc;

class DispatchTest extends \PHPUnit_Framework_TestCase
{
    public function testDispatch()
    {
        ob_start();
        \Phpfox::get('mvc.dispatch')->run();
        $result = ob_get_clean();

        \Phpfox::get('main.log')->info($result);
    }
}
