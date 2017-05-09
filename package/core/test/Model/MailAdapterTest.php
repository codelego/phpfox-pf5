<?php

namespace Neutron\Core\Model;

class MailAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'System',  'driver_id' => 'system',  'params' => '{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}',  'is_active' => 1,  'is_required' => 1,  'description' => '',));

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new MailAdapter();

        // set data
        $obj->setId(1);
        $obj->setAdapterName('System');
        $obj->setDriverId('system');
        $obj->setParams('{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}');
        $obj->setActive(1);
        $obj->setRequired(1);
        $obj->setDescription('');

        // assert same data
        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new MailAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'System',  'driver_id' => 'system',  'params' => '{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}',  'is_active' => 1,  'is_required' => 1,  'description' => '',));

        $obj->save();

        /** @var MailAdapter $obj */
        $obj = _model('mail_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('mail_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('System', $obj->getAdapterName());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"phpFox Team","replyAddress":"no-reply@younetco.com","replyName":"Reply"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('mail_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('mail_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}