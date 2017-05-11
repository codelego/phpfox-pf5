<?php
namespace Neutron\Core\Model;

class CacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CacheAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'File System',  'driver_id' => 'files',  'params' => '[]',  'is_active' => 1,  'is_required' => 1,  'description' => '',));

        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('File System', $obj->getAdapterName());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new CacheAdapter();

        // set data
        $obj->setAdapterId(1);
        $obj->setAdapterName('File System');
        $obj->setDriverId('files');
        $obj->setParams('[]');
        $obj->setActive(1);
        $obj->setRequired(1);
        $obj->setDescription('');
        // assert same data
        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('File System', $obj->getAdapterName());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new CacheAdapter(array (  'adapter_id' => 1,  'adapter_name' => 'File System',  'driver_id' => 'files',  'params' => '[]',  'is_active' => 1,  'is_required' => 1,  'description' => '',));

        $obj->save();

        /** @var CacheAdapter $obj */
        $obj = _model('cache_adapter')
            ->select()->where('adapter_id=?',1)->first();

        $this->assertSame('cache_adapter', $obj->getModelId());
        $this->assertSame(1, $obj->getAdapterId());
        $this->assertSame('File System', $obj->getAdapterName());
        $this->assertSame('files', $obj->getDriverId());
        $this->assertSame('[]', $obj->getParams());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('cache_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('cache_adapter')
            ->delete()->where('adapter_id=?',1)->execute();
    }
}