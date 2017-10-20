<?php

namespace Phpfox\Session;

class FilesSessionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (session_id()) {
            session_destroy();
        }
    }

    public function testBase()
    {
        $filesSession = new FilesSession();

        $filesSession->register();

        $this->assertEquals('files', ini_get('session.save_handler'));
        $this->assertEquals(PHPFOX_SESSION_DIR, ini_get('session.save_path'));
    }

    public function testBase2()
    {
        exec('rm -rf ' . PHPFOX_SESSION_DIR);

        $filesSession = new FilesSession();

        $filesSession->register();

        $this->assertEquals('files', ini_get('session.save_handler'));
        $this->assertEquals(PHPFOX_SESSION_DIR, ini_get('session.save_path'));
    }
}
