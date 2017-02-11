<?php

namespace Neutron\Notification\Model;


class NotificationSettingTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new NotificationSetting(['user_id' => 22, 'params' => '[]',]);

        $this->assertSame('notification_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new NotificationSetting();

        // set data
        $obj->setUserId(22);
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('notification_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new NotificationSetting(['user_id' => 22, 'params' => '[]',]);

        $obj->save();

        /** @var NotificationSetting $obj */
        $obj = \Phpfox::with('notification_setting')
            ->select()
            ->where('user_id=?', '22')
            ->first();

        $this->assertSame('notification_setting', $obj->getModelId());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('notification_setting')
            ->delete()
            ->where('user_id=?', '22')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('notification_setting')
            ->delete()
            ->where('user_id=?', '22')
            ->execute();
    }
}