<?php

namespace Neutron\Core\Service;


use Phpfox\Mailer\MailTransportInterface;

class MailTransportFactoryTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        _get('db')
            ->delete(':mail_adapter')->execute();

        _get('db')->insert(':mail_adapter', [
            'adapter_id'   => 1,
            'adapter_name' => 'SMTP #1',
            'driver_id'    => 'smtp',
            'params'       => '[]',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '[]',
        ])->execute();
    }

    public function testInitialize()
    {
        $obj = new MailTransportFactory();

        $entry = $obj->factory(0);
        $this->assertTrue($entry instanceof MailTransportInterface);
    }

    public function testDefault()
    {
        $obj = new MailTransportFactory();
        $entry = $obj->factory('default');
        $this->assertTrue($entry instanceof MailTransportInterface);
    }

    public function testFallback()
    {
        $obj = new MailTransportFactory();
        $entry = $obj->factory('fallback');
        $this->assertTrue($entry instanceof MailTransportInterface);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can not initialize mail transport
     */
    public function testFalure()
    {
        $obj = new MailTransportFactory();
        $entry = $obj->factory(-1);
        $this->assertTrue($entry instanceof MailTransportInterface);
    }
}
