<?php

namespace Neutron\Request\Model;


class RequestSettingTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new RequestSetting(['user_id' => 22, 'params' => '[]',]);

        $this->assertSame('request_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new RequestSetting();

        // set data
        $obj->setUserId(22);
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('request_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new RequestSetting(['user_id' => 22, 'params' => '[]',]);

        $obj->save();

        /** @var RequestSetting $obj */
        $obj = _with('request_setting')
            ->select()
            ->where('user_id=?', '22')
            ->first();

        $this->assertSame('request_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        _with('request_setting')
            ->delete()
            ->where('user_id=?', '22')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('request_setting')
            ->delete()
            ->where('user_id=?', '22')
            ->execute();
    }
}