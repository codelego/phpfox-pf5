<?php

namespace Neutron\Core\Model;

class CoreLogTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreLog([
            'id'      => 1,
            'ip'      => '',
            'updated' => '2016-12-23 18:45:17',
            'level'   => 'alert',
            'message' => 'log message 1482515117',
            'created' => '2016-12-23 18:45:17',
        ]);

        $this->assertSame('core_log', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('2016-12-23 18:45:17', $obj->getUpdated());
        $this->assertSame('alert', $obj->getLevel());
        $this->assertSame('log message 1482515117', $obj->getMessage());
        $this->assertSame('2016-12-23 18:45:17', $obj->getCreated());
    }

    public function testParameters()
    {
        $obj = new CoreLog();

        // set data
        $obj->setId(1);
        $obj->setIp('');
        $obj->setUpdated('2016-12-23 18:45:17');
        $obj->setLevel('alert');
        $obj->setMessage('log message 1482515117');
        $obj->setCreated('2016-12-23 18:45:17');
        // assert same data
        $this->assertSame('core_log', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('2016-12-23 18:45:17', $obj->getUpdated());
        $this->assertSame('alert', $obj->getLevel());
        $this->assertSame('log message 1482515117', $obj->getMessage());
        $this->assertSame('2016-12-23 18:45:17', $obj->getCreated());
    }

    public function testSave()
    {
        $obj = new CoreLog([
            'id'      => 1,
            'ip'      => '',
            'updated' => '2016-12-23 18:45:17',
            'level'   => 'alert',
            'message' => 'log message 1482515117',
            'created' => '2016-12-23 18:45:17',
        ]);

        $obj->save();

        /** @var CoreLog $obj */
        $obj = _model('core_log')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('core_log', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getIp());
        $this->assertSame('2016-12-23 18:45:17', $obj->getUpdated());
        $this->assertSame('alert', $obj->getLevel());
        $this->assertSame('log message 1482515117', $obj->getMessage());
        $this->assertSame('2016-12-23 18:45:17', $obj->getCreated());
    }

    public static function setUpBeforeClass()
    {
        _model('core_log')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_log')
            ->delete()->where('id=?', 1)->execute();
    }
}