<?php

namespace Neutron\Report\Model;


class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Report([
            'message'    => 'message content',
            'created_at' => '2016-10-12 00:00:00',
            'user_id'    => 100,
            'about_type' => 'user',
            'about_id'   => 21,
        ]);

        $this->assertEquals('report', $obj->getModelId());
        $this->assertEquals('message content', $obj->getMessage());
        $this->assertEquals(100, $obj->getUserId());
        $this->assertEquals('user', $obj->getAboutType());
        $this->assertEquals('21', $obj->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $obj->getCreatedAt());
        $this->assertEquals(0, $obj->getCategoryId());
        $this->assertFalse($obj->isSaved());

    }

    public function testSetter()
    {
        $obj = new Report();

        $obj->setMessage('message content');
        $obj->setCreatedAt('2016-10-12 00:00:00');
        $obj->setUserId(100);
        $obj->setAboutType('user');
        $obj->setAboutId(21);

        $this->assertEquals('report', $obj->getModelId());
        $this->assertEquals('message content', $obj->getMessage());
        $this->assertEquals(100, $obj->getUserId());
        $this->assertEquals('user', $obj->getAboutType());
        $this->assertEquals('21', $obj->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $obj->getCreatedAt());
        $this->assertEquals(0, $obj->getCategoryId());

        $this->assertFalse($obj->isSaved());
    }

    public function testSave()
    {
        $obj = new Report([
            'message'    => 'message content',
            'created_at' => '2016-10-12 00:00:00',
            'user_id'    => 100,
            'about_type' => 'user',
            'about_id'   => 21,
        ]);

        $obj->save();

        /** @var Report $obj */
        $obj = \Phpfox::with('report')
            ->select()
            ->where('user_id=?', 100)
            ->where('created_at=?', '2016-10-12 00:00:00')
            ->first();

        $this->assertEquals('report', $obj->getModelId());
        $this->assertEquals('message content', $obj->getMessage());
        $this->assertEquals(100, $obj->getUserId());
        $this->assertEquals('user', $obj->getAboutType());
        $this->assertEquals('21', $obj->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $obj->getCreatedAt());
        $this->assertEquals(0, $obj->getCategoryId());
        $this->assertTrue($obj->isSaved());

        $obj->delete();

    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')->delete(':report')
            ->where('created_at=?', '2016-10-12 00:00:00')
            ->where('user_id=?', 100)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')->delete(':report')
            ->where('user_id=?', 100)
            ->where('created_at=?', '2016-10-12 00:00:00')
            ->execute();
    }
}
