<?php
namespace Neutron\Core\Model;

class LogAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LogAdapter(array (  'adapter_id' => 1,  'container_id' => 'main.log',  'title' => 'Log to files',  'driver_id' => 'files',  'params' => '[]',  'description' => 'Default file logger',));

        $this->assertSame('log_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('main.log', $obj->getContainerId());
        $this->assertSame('Log to files', $obj->getTitle());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('Default file logger', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new LogAdapter();

        // set data
        $obj->setAdapterId(1);
        $obj->setContainerId('main.log');
        $obj->setTitle('Log to files');
        $obj->setDriverId('files');
        $obj->setParams('[]');
        $obj->setDescription('Default file logger');
        // assert same data
        $this->assertSame('log_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('main.log', $obj->getContainerId());
        $this->assertSame('Log to files', $obj->getTitle());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('Default file logger', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new LogAdapter(array (  'adapter_id' => 1,  'container_id' => 'main.log',  'title' => 'Log to files',  'driver_id' => 'files',  'params' => '[]',  'description' => 'Default file logger',));

        $obj->save();

        /** @var LogAdapter $obj */
        $obj = _model('log_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('log_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('main.log', $obj->getContainerId());
        $this->assertSame('Log to files', $obj->getTitle());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame('Default file logger', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('log_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('log_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}