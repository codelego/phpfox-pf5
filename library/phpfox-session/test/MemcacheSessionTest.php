<?php

namespace Phpfox\Session;


class MemcacheSessionTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $session = new MemcacheSession();

        $session->register();

        $this->assertEquals('memcache', ini_get('session.save_handler'));
        $this->assertEquals($session->getSavePath(),
            ini_get('session.save_path'));

    }

    public function testBase2()
    {
        $savePath = 'tcp://127.0.0.1:21211';

        $session = new MemcacheSession();

        $session->setSavePath($savePath);

        $this->assertEquals($savePath, $session->getSavePath());

        $session->register();

        $this->assertEquals('memcache', ini_get('session.save_handler'));
        $this->assertEquals($savePath,
            ini_get('session.save_path'));

    }
}
