<?php

namespace Neutron\Core\Model;

class CoreAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreAdapter();

        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getDriverType());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new CoreAdapter();

        // set data
        $obj->setAdapterId('');
        $obj->setDriverType('');
        $obj->setDriverId('');
        $obj->setActive('');
        $obj->setRequired('');
        $obj->setParams('');
        $obj->setTitle('');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getDriverType());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new CoreAdapter();

        $obj->save();

        /** @var CoreAdapter $obj */
        $obj = _model('core_adapter')
            ->select()->where('adapter_id=?', '')->first();

        $this->assertSame('core_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getDriverType());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->getTitle());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('core_adapter')
            ->delete()->where('adapter_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_adapter')
            ->delete()->where('adapter_id=?', '')->execute();
    }
}