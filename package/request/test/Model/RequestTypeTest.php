<?php

namespace Neutron\Request\Model;


class RequestTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new RequestType([
            'type_id'    => '[comment_add]',
            'package_id' => '[comment]',
            'content'    => '[example_content]',
            'handler_id' => '[handler_id]',
            'is_default' => 1,
        ]);

        $this->assertSame('request_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public function testParameters()
    {
        $obj = new RequestType();

        // set data
        $obj->setTypeId('[comment_add]');
        $obj->setPackageId('[comment]');
        $obj->setContent('[example_content]');
        $obj->setHandlerId('[handler_id]');
        $obj->setDefault(1);

        // assert same data
        $this->assertSame('request_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public function testSave()
    {
        $obj = new RequestType([
            'type_id'    => '[comment_add]',
            'package_id' => '[comment]',
            'content'    => '[example_content]',
            'handler_id' => '[handler_id]',
            'is_default' => 1,
        ]);

        $obj->save();

        /** @var RequestType $obj */
        $obj = _with('request_type')
            ->select()
            ->where('type_id=?', '[comment_add]')
            ->first();

        $this->assertSame('request_type', $obj->getModelId());
        $this->assertSame('[comment_add]', $obj->getTypeId());
        $this->assertSame('[comment]', $obj->getPackageId());
        $this->assertSame('[example_content]', $obj->getContent());
        $this->assertSame('[handler_id]', $obj->getHandlerId());
        $this->assertSame(1, $obj->isDefault());
    }

    public static function setUpBeforeClass()
    {
        _with('request_type')
            ->delete()
            ->where('type_id=?', '[comment_add]')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('request_type')
            ->delete()
            ->where('type_id=?', '[comment_add]')
            ->execute();
    }
}