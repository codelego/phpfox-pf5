<?php

namespace Phpfox\Session;


class NullSessionTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $session = new NullSession();

        $session->register();

        $this->assertTrue($session->gc(100));
        $this->assertTrue($session->open('save_path', 'session_id_0'));
        $this->assertEmpty($session->read('session_id_0'));
        $this->assertTrue($session->write('session_id_0', 'session_data_0'));
        $this->assertTrue($session->close());
        $this->assertTrue($session->destroy('session_id_0'));
    }
}
