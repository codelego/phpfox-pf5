<?php
namespace Phpfox\Session;


class SessionManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testSaveHandler()
    {
        \Phpfox::get('session')->start();
    }
}
