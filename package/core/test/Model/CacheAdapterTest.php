<?php

namespace Neutron\Core\Model;

class CacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CacheAdapter();

        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getAdapterName());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new CacheAdapter();

        // set data
        $obj->setId('');
        $obj->setAdapterName('');
        $obj->setDriverId('');
        $obj->setParams('');
        $obj->setActive('');
        $obj->setRequired('');
        $obj->setDescription('');

        // assert same data
        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getAdapterName());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new CacheAdapter();

        $obj->save();

        /** @var CacheAdapter $obj */
        $obj = _model('cache_adapter')
            ->select()->where('adapter_id=?','')->first();

        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getAdapterName());
        $this->assertSame('', $obj->getDriverId());
        $this->assertSame('', $obj->getParams());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isRequired());
        $this->assertSame('', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('cache_adapter')
            ->delete()->where('adapter_id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('cache_adapter')
            ->delete()->where('adapter_id=?','')->execute();
    }
}