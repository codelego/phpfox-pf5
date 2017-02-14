<?php

namespace Neutron\Core\Model;

class MailAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailAdapter([
            'adapter_id'   => 2,
            'adapter_name' => 'SMTP',
            'driver_id'    => 'smtp',
            'params'       => '{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '',
        ]);

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('SMTP', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}',
            $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new MailAdapter();

        // set data
        $obj->setId(2);
        $obj->setAdapterName('SMTP');
        $obj->setDriverId('smtp');
        $obj->setParams('{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}');
        $obj->setActive(1);
        $obj->setDefault(1);
        $obj->setFallback(1);
        $obj->setDescription('');

        // assert same data
        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('SMTP', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}',
            $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new MailAdapter([
            'adapter_id'   => 2,
            'adapter_name' => 'SMTP',
            'driver_id'    => 'smtp',
            'params'       => '{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}',
            'is_active'    => 1,
            'is_default'   => 1,
            'is_fallback'  => 1,
            'description'  => '',
        ]);

        $obj->save();

        /** @var MailAdapter $obj */
        $obj = \Phpfox::with('mail_adapter')
            ->select()->where('adapter_id=?', 2)->first();

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('SMTP', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"host":"smtp.sendgrid.net","port":587,"username":"phpfoxdemo","password":"Demo@Fox16","auth":true,"secure":"tls"}',
            $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('mail_adapter')
            ->delete()->where('adapter_id=?', 2)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('mail_adapter')
            ->delete()->where('adapter_id=?', 2)->execute();
    }
}