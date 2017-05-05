<?php

namespace Neutron\Report\Model;

class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Report([
            'report_id'   => 85,
            'category_id' => 3,
            'message'     => 'message content',
            'user_id'     => 100,
            'about_id'    => 21,
            'about_type'  => 'user',
            'created_at'  => '2012-10-10 00:22:44',
        ]);

        $this->assertSame('report', $obj->getModelId());
        $this->assertSame(85, $obj->getId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('2012-10-10 00:22:44', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Report();

        // set data
        $obj->setId(85);
        $obj->setCategoryId(3);
        $obj->setMessage('message content');
        $obj->setUserId(100);
        $obj->setAboutId(21);
        $obj->setAboutType('user');
        $obj->setCreatedAt('2012-10-10 00:22:44');

        // assert same data
        $this->assertSame('report', $obj->getModelId());
        $this->assertSame(85, $obj->getId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('2012-10-10 00:22:44', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Report([
            'report_id'   => 85,
            'category_id' => 3,
            'message'     => 'message content',
            'user_id'     => 100,
            'about_id'    => 21,
            'about_type'  => 'user',
            'created_at'  => '2012-10-10 00:22:44',
        ]);

        $obj->save();

        /** @var Report $obj */
        $obj = _model('report')
            ->select()->where('report_id=?', 85)->first();

        $this->assertSame('report', $obj->getModelId());
        $this->assertSame(85, $obj->getId());
        $this->assertSame(3, $obj->getCategoryId());
        $this->assertSame('message content', $obj->getMessage());
        $this->assertSame(100, $obj->getUserId());
        $this->assertSame(21, $obj->getAboutId());
        $this->assertSame('user', $obj->getAboutType());
        $this->assertSame('2012-10-10 00:22:44', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _model('report')
            ->delete()->where('report_id=?', 85)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('report')
            ->delete()->where('report_id=?', 85)->execute();
    }
}