<?php
namespace Phpfox\Session;

/**
 * @runInSeparateProcess
 */
class SessionManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $manager = new SessionManager();

        $manager->start();

        $this->assertFalse($manager->start());

        $manager->remember();

        $this->assertNull($manager->get('example_key'));

        $example_value = ['abc'];
        $example_key = 'example_key';
        $manager->set('example_key', $example_value);

        $this->assertEquals($example_value, $manager->get('example_key'));

        $manager->delete('example_key');


        $this->assertEmpty($manager->get($example_key));

        $manager->destroy();

        $manager->close();
    }

    public function testBase2()
    {
        $session = new SessionManager();

        if (session_id()) {
            session_destroy();
        }

        $this->assertFalse($session->start());
    }

    public function testBase3()
    {
        if (!session_id() and !headers_sent()) {
            session_start();
        }

        $manager = new SessionManager();

        $manager->start();

        $this->assertFalse($manager->start());

        $manager->remember();

        $this->assertNull($manager->get('example_key'));

        $example_value = ['abc'];
        $example_key = 'example_key';
        $manager->set('example_key', $example_value);

        $this->assertEquals($example_value, $manager->get('example_key'));

        $manager->delete('example_key');


        $this->assertEmpty($manager->get($example_key));

        $manager->destroy();

        $manager->close();
    }

    public function testBase4()
    {
        if (!session_id() and !headers_sent()) {
            session_start();
        }

        $manager = new SessionManager();
        $this->assertFalse($manager->start());
    }
}
