<?php

namespace Neutron\Core\Model;

class StorageAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'Local File System',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1"}',  'is_active' => 1,  'is_required' => 1,  'description' => '[description]',));

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local File System', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new StorageAdapter();

        // set data
        $obj->setId(1);
        $obj->setAdapterName('Local File System');
        $obj->setDriverId('local');
        $obj->setParams('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1"}');
        $obj->setActive(1);
        $obj->setRequired(1);
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local File System', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'Local File System',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1"}',  'is_active' => 1,  'is_required' => 1,  'description' => '[description]',));

        $obj->save();

        /** @var StorageAdapter $obj */
        $obj = _model('storage_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('Local File System', $obj->getAdapterName());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        _model('storage_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('storage_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}