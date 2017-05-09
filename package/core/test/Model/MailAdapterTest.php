<?php

namespace Neutron\Core\Model;

class MailAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'System',  'driver_id' => 'smtp',  'params' => '{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}',  'is_active' => 1,  'is_required' => 0,  'is_default' => 1,  'is_fallback' => 1,  'description' => '[]',));

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isRequired());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('[]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new MailAdapter();

        // set data
        $obj->setId(1);
        $obj->setAdapterName('System');
        $obj->setDriverId('smtp');
        $obj->setParams('{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}');
        $obj->setActive(1);
        $obj->setRequired(0);
        $obj->setDefault(1);
        $obj->setFallback(1);
        $obj->setDescription('[]');

        // assert same data
        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isRequired());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('[]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new MailAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'System',  'driver_id' => 'smtp',  'params' => '{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}',  'is_active' => 1,  'is_required' => 0,  'is_default' => 1,  'is_fallback' => 1,  'description' => '[]',));

        $obj->save();

        /** @var MailAdapter $obj */
        $obj = _with('mail_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('smtp', $obj->getDriverId());
        $this->assertSame('{"mail__from_address":"namnv@younetco.com","mail__from_name":"Nam Nguyen","mail__reply_address":"noreply@younetco.com","mail__reply_name":"NoReply","mail__smtp_host":"127.0.0.1","mail__smtp_port":"25","mail__smtp_security":"none","mail__smtp_authentication":"0","mail__smtp_username":"","mail__smtp_password":""}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isRequired());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isFallback());
        $this->assertSame('[]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _with('mail_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('mail_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}