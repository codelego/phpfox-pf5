<?php

namespace Neutron\Notification\Model;


class NotificationTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new NotificationType([
            'type_id'    => '[comment_add]',
            'package_id' => '[comment]',
            'content'    => '[example_content]',
            'handler_id' => '[handler_id]',
            'is_default' => 1,
        ]);

        $this->assertSame('notification_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public function testParameters()
    {
        $obj = new NotificationType();

        // set data
        $obj->setTypeId('[comment_add]');
        $obj->setPackageId('[comment]');
        $obj->setContent('[example_content]');
        $obj->setHandlerId('[handler_id]');
        $obj->setDefault(1);

        // assert same data
        $this->assertSame('notification_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public function testSave()
    {
        $obj = new NotificationType([
            'type_id'    => '[comment_add]',
            'package_id' => '[comment]',
            'content'    => '[example_content]',
            'handler_id' => '[handler_id]',
            'is_default' => 1,
        ]);

        $obj->save();

        /** @var NotificationType $obj */
        $obj = _with('notification_type')
            ->select()
            ->where('type_id=?', '[comment_add]')
            ->first();

        $this->assertSame('notification_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public static function setUpBeforeClass()
    {
        _with('notification_type')
            ->delete()
            ->where('type_id=?', '[comment_add]')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('notification_type')
            ->delete()
            ->where('type_id=?', '[comment_add]')
            ->execute();
    }
}