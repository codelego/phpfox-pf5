<?php

namespace Phpfox\Session;


class RedisSessionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $session = new RedisSession();

        $session->register();

        $this->assertEquals('redis', ini_get('session.save_handler'));
        $this->assertEquals($session->getSavePath(),
            ini_get('session.save_path'));

    }

    public function testBase2()
    {
        $savePath = 'tcp://192.168.1.211:6379';

        $session = new RedisSession();

        $session->setSavePath($savePath);

        $this->assertEquals($savePath, $session->getSavePath());

        $session->register();

        $this->assertEquals('redis', ini_get('session.save_handler'));
        $this->assertEquals($savePath,
            ini_get('session.save_path'));

    }
}
