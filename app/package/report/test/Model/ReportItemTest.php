<?php

namespace Neutron\Report\Model;

class ReportItemTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ReportItem(array (  'item_id' => 86,  'category_id' => 0,  'message' => 'message content',  'user_id' => 100,  'about_id' => 21,  'about_type' => 'user',  'created_at' => '0000-00-00 00:00:00',));

        $this->assertSame('report_item', $obj->getModelId());
        $this->assertSame(86, $obj->getId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new ReportItem();

        // set data
        $obj->setId(86);
        $obj->setCategoryId(0);
        $obj->setMessage('message content');
        $obj->setUserId(100);
        $obj->setAboutId(21);
        $obj->setAboutType('user');
        $obj->setCreatedAt('0000-00-00 00:00:00');

        // assert same data
        $this->assertSame('report_item', $obj->getModelId());
        $this->assertSame(86, $obj->getId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new ReportItem(array (  'item_id' => 86,  'category_id' => 0,  'message' => 'message content',  'user_id' => 100,  'about_id' => 21,  'about_type' => 'user',  'created_at' => '0000-00-00 00:00:00',));

        $obj->save();

        /** @var ReportItem $obj */
        $obj = _model('report_item')
            ->select()->where('item_id=?',86)->first();

        $this->assertSame('report_item', $obj->getModelId());
        $this->assertSame(86, $obj->getId());
        $this->assertSame(0, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('0000-00-00 00:00:00', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _model('report_item')
            ->delete()->where('item_id=?',86)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('report_item')
            ->delete()->where('item_id=?',86)->execute();
    }
}