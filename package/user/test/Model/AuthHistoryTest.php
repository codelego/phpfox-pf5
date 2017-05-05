<?php

namespace Neutron\User\Model;


class AuthHistoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $deviceName
            = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2';
        $obj = new AuthHistory([
            'id'             => 2,
            'user_id'        => 1,
            'remote_address' => '::1',
            'device_name'    => $deviceName,
            'created_at'     => '2017-01-18 08:48:26',
        ]);

        $this->assertEquals('auth_history', $obj->getModelId());
        $this->assertEquals(2, $obj->getId());
        $this->assertSame(1, $obj->getUserId());
        $this->assertSame($deviceName, $obj->getDeviceName());
        $this->assertSame('::1', $obj->getRemoteAddress());
        $this->assertSame('2017-01-18 08:48:26', $obj->getCreatedAt());

        $obj->setCreatedAt('2017-01-18 08:48:26');
        $obj->setRemoteAddress('remote address');
        $obj->setUserId('4');
        $obj->setDeviceName('device name');

        $this->assertEquals(2, $obj->getId());
        $this->assertSame(4, $obj->getUserId());
        $this->assertSame('device name', $obj->getDeviceName());
        $this->assertSame('remote address', $obj->getRemoteAddress());
        $this->assertSame('2017-01-18 08:48:26', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new AuthHistory([
            'user_id'        => 1,
            'remote_address' => '::0',
            'device_name'    => 'device name',
            'created_at'     => '2017-01-18 08:48:26',
        ]);

        $obj->save();

        /** @var AuthHistory $entry */
        $entry = _model('auth_history')
            ->select()
            ->where('remote_address=?', '::0')
            ->first();

        $this->assertNotNull($entry);
        $this->assertEquals('auth_history', $entry->getModelId());
        $this->assertSame(1, $entry->getUserId());
        $this->assertSame('device name', $entry->getDeviceName());
        $this->assertSame('::0', $entry->getRemoteAddress());
        $this->assertSame('2017-01-18 08:48:26', $entry->getCreatedAt());

        $obj->delete();
    }

    public static function tearDownAfterClass()
    {
        _service('db')
            ->delete(':auth_history')
            ->where('remote_address=?', '::0')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        _service('db')
            ->delete(':auth_history')
            ->where('remote_address=?', '::0')
            ->execute();
    }
}
