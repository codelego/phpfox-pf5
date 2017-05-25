<?php
namespace Neutron\Core\Model;

class ProfileProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileProcess(array (  'process_id' => 1,  'item_type' => 'user',  'process_type' => 'create',  'catalog_id' => 1,));

        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('create', $obj->getProcessType());
        $this->assertSame(1, $obj->getCatalogId());    }

    public function testParameters()
    {
        $obj = new ProfileProcess();

        // set data
        $obj->setProcessId(1);
        $obj->setItemType('user');
        $obj->setProcessType('create');
        $obj->setCatalogId(1);
        // assert same data
        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('create', $obj->getProcessType());
        $this->assertSame(1, $obj->getCatalogId());    }

    public function testSave()
    {
        $obj = new ProfileProcess(array (  'process_id' => 1,  'item_type' => 'user',  'process_type' => 'create',  'catalog_id' => 1,));

        $obj->save();

        /** @var ProfileProcess $obj */
        $obj = _model('profile_process')
            ->select()->where('process_id=?',1)->first();

        $this->assertSame('profile_process', $obj->getModelId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('create', $obj->getProcessType());
        $this->assertSame(1, $obj->getCatalogId());    }

    public static function setUpBeforeClass()
    {
        _model('profile_process')
            ->delete()->where('process_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_process')
            ->delete()->where('process_id=?',1)->execute();
    }
}