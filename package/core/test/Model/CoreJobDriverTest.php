<?php
namespace Neutron\Core\Model;

class CoreJobDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreJobDriver();

        $this->assertSame('core_job_driver', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getDriver());
        $this->assertSame('', $obj->getJsonConfigs());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isDefault());
        $this->assertSame('', $obj->isFallback());    }

    public function testParameters()
    {
        $obj = new CoreJobDriver();

        // set data
        $obj->setId('');
        $obj->setDriver('');
        $obj->setJsonConfigs('');
        $obj->setActive('');
        $obj->setDefault('');
        $obj->setFallback('');
        // assert same data
        $this->assertSame('core_job_driver', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getDriver());
        $this->assertSame('', $obj->getJsonConfigs());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isDefault());
        $this->assertSame('', $obj->isFallback());    }

    public function testSave()
    {
        $obj = new CoreJobDriver();

        $obj->save();

        /** @var CoreJobDriver $obj */
        $obj = _model('core_job_driver')
            ->select()->where('id=?','')->first();

        $this->assertSame('core_job_driver', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getDriver());
        $this->assertSame('', $obj->getJsonConfigs());
        $this->assertSame('', $obj->isActive());
        $this->assertSame('', $obj->isDefault());
        $this->assertSame('', $obj->isFallback());    }

    public static function setUpBeforeClass()
    {
        _model('core_job_driver')
            ->delete()->where('id=?','')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_job_driver')
            ->delete()->where('id=?','')->execute();
    }
}