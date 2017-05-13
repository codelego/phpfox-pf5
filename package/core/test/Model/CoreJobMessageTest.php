<?php

namespace Neutron\Core\Model;

class CoreJobMessageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreJobMessage();

        $this->assertSame('core_job_message', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getQueue());
        $this->assertSame('', $obj->getData());
        $this->assertSame('', $obj->getExpiration());
        $this->assertSame('', $obj->getStatusId());
        $this->assertSame('', $obj->getDeliveredAt());
    }

    public function testParameters()
    {
        $obj = new CoreJobMessage();

        // set data
        $obj->setId('');
        $obj->setQueue('');
        $obj->setData('');
        $obj->setExpiration('');
        $obj->setStatusId('');
        $obj->setDeliveredAt('');
        // assert same data
        $this->assertSame('core_job_message', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getQueue());
        $this->assertSame('', $obj->getData());
        $this->assertSame('', $obj->getExpiration());
        $this->assertSame('', $obj->getStatusId());
        $this->assertSame('', $obj->getDeliveredAt());
    }

    public function testSave()
    {
        $obj = new CoreJobMessage();

        $obj->save();

        /** @var CoreJobMessage $obj */
        $obj = _model('core_job_message')
            ->select()->where('id=?', '')->first();

        $this->assertSame('core_job_message', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getQueue());
        $this->assertSame('', $obj->getData());
        $this->assertSame('', $obj->getExpiration());
        $this->assertSame('', $obj->getStatusId());
        $this->assertSame('', $obj->getDeliveredAt());
    }

    public static function setUpBeforeClass()
    {
        _model('core_job_message')
            ->delete()->where('id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_job_message')
            ->delete()->where('id=?', '')->execute();
    }
}