<?php
namespace Neutron\Core\Model;

class CoreJobLogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreJobLog();

        $this->assertSame('core_job_log', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('', $obj->getUpdated());
        $this->assertSame('', $obj->getLevel());
        $this->assertSame('', $obj->getMessage());    }

    public function testParameters()
    {
        $obj = new CoreJobLog();

        // set data
        $obj->setId('');
        $obj->setIp('');
        $obj->setUpdated('');
        $obj->setLevel('');
        $obj->setMessage('');
        // assert same data
        $this->assertSame('core_job_log', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('', $obj->getUpdated());
        $this->assertSame('', $obj->getLevel());
        $this->assertSame('', $obj->getMessage());    }

    public function testSave()
    {
        $obj = new CoreJobLog();

        $obj->save();

        /** @var CoreJobLog $obj */
        $obj = _model('core_job_log')
            ->select()->where('id=?','')->first();

        $this->assertSame('core_job_log', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('', $obj->getUpdated());
        $this->assertSame('', $obj->getLevel());
        $this->assertSame('', $obj->getMessage());    }

    public static function setUpBeforeClass()
    {
        _model('core_job_log')
            ->delete()->where('id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_job_log')
            ->delete()->where('id=?','')->execute();
    }
}