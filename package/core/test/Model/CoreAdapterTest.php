<?php
namespace Neutron\Core\Model;

class CoreAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreAdapter(array (  'adapter_id' => 1,  'driver_type' => 'mail',  'driver_id' => 'system',  'is_active' => 1,  'is_default' => 0,  'is_required' => 1,  'container_id' => 'shared.mailer',  'params' => '{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}',  'title' => 'System mail',  'description' => '',));

        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('mail', $obj->getDriverType());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('shared.mailer', $obj->getContainerId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}', $obj->getParams());
        $this->assertSame('System mail', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new CoreAdapter();

        // set data
        $obj->setAdapterId(1);
        $obj->setDriverType('mail');
        $obj->setDriverId('system');
        $obj->setActive(1);
        $obj->setDefault(0);
        $obj->setRequired(1);
        $obj->setContainerId('shared.mailer');
        $obj->setParams('{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}');
        $obj->setTitle('System mail');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('mail', $obj->getDriverType());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('shared.mailer', $obj->getContainerId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}', $obj->getParams());
        $this->assertSame('System mail', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new CoreAdapter(array (  'adapter_id' => 1,  'driver_type' => 'mail',  'driver_id' => 'system',  'is_active' => 1,  'is_default' => 0,  'is_required' => 1,  'container_id' => 'shared.mailer',  'params' => '{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}',  'title' => 'System mail',  'description' => '',));

        $obj->save();

        /** @var CoreAdapter $obj */
        $obj = _model('core_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('mail', $obj->getDriverType());
        $this->assertSame('system', $obj->getDriverId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('shared.mailer', $obj->getContainerId());
        $this->assertSame('{"fromAddress":"namnv@younetco.com","fromName":"namnv","replyAddress":"namnv@younetco.com","replyName":"namnv"}', $obj->getParams());
        $this->assertSame('System mail', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('core_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}