<?php
namespace Neutron\Core\Model;

class StorageAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'title' => 'Local File System',  'description' => '[description]',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1","title":"Local path public"}',  'is_active' => 1,  'is_required' => 1,));

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local File System', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local path public"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());    }

    public function testParameters()
    {
        $obj = new StorageAdapter();

        // set data
        $obj->setAdapterId(1);
        $obj->setTitle('Local File System');
        $obj->setDescription('[description]');
        $obj->setDriverId('local');
        $obj->setParams('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local path public"}');
        $obj->setActive(1);
        $obj->setRequired(1);
        // assert same data
        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local File System', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local path public"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());    }

    public function testSave()
    {
        $obj = new StorageAdapter(array (  'adapter_id' => 1,  'title' => 'Local File System',  'description' => '[description]',  'driver_id' => 'local',  'params' => '{"basePath":"public","baseUrl":"http:\\/\\/namnv.local\\/pf5\\/","baseCdnUrl":"http:\\/\\/aws.max-cdn.com\\/adbc\\/","is_active":"1","title":"Local path public"}',  'is_active' => 1,  'is_required' => 1,));

        $obj->save();

        /** @var StorageAdapter $obj */
        $obj = _model('storage_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('storage_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('Local File System', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame('local', $obj->getDriverId());
        $this->assertSame('{"basePath":"public","baseUrl":"http:\/\/namnv.local\/pf5\/","baseCdnUrl":"http:\/\/aws.max-cdn.com\/adbc\/","is_active":"1","title":"Local path public"}', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());    }

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