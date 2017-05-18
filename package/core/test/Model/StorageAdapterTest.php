<?php
namespace Neutron\Core\Model;

class StorageAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'title' => 'Local `public`',  'description' => '[description]',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1","title":"Local `public`"}',  'is_active' => 1,  'is_required' => 1,  'is_default' => 0,));

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local `public`', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local `public`"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(0, $obj->isDefault());    }

    public function testParameters()
    {
        $obj = new StorageAdapter();

        // set data
        $obj->setAdapterId(1);
        $obj->setTitle('Local `public`');
        $obj->setDescription('[description]');
        $obj->setDriverId('local');
        $obj->setParams('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local `public`"}');
        $obj->setActive(1);
        $obj->setRequired(1);
        $obj->setDefault(0);
        // assert same data
        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local `public`', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local `public`"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(0, $obj->isDefault());    }

    public function testSave()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'title' => 'Local `public`',  'description' => '[description]',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1","title":"Local `public`"}',  'is_active' => 1,  'is_required' => 1,  'is_default' => 0,));

        $obj->save();

        /** @var StorageAdapter $obj */
        $obj = _model('storage_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local `public`', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local `public`"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(0, $obj->isDefault());    }

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