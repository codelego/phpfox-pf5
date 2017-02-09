<?php

namespace Neutron\AbuseReport\Model;


class ReportTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $report = new Report();

        $report->fromArray([
            'message'    => 'message content',
            'created'    => '2016-10-12 00:00:00',
            'user_id'    => 100,
            'about_type' => 'user',
            'about_id'   => 21,
        ]);

        $report->save();

        $this->assertEquals('message content', $report->getMessage());
        $this->assertEquals(100, $report->getUserId());
        $this->assertEquals('user', $report->getAboutType());
        $this->assertEquals('21', $report->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $report->getCreated());
        $this->assertEquals(0, $report->getCategoryId());

        $this->assertTrue($report->isSaved());

        $report->delete();
    }

    public function testBase2()
    {
        $report = new Report();

        $report->setMessage('message content');
        $report->setCreated('2016-10-12 00:00:00');
        $report->setUserId(100);
        $report->setAboutType('user');
        $report->setAboutId(21);
        $report->save();

        $this->assertEquals('message content', $report->getMessage());
        $this->assertEquals(100, $report->getUserId());
        $this->assertEquals('user', $report->getAboutType());
        $this->assertEquals('21', $report->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $report->getCreated());
        $this->assertEquals(0, $report->getCategoryId());

        $this->assertTrue($report->isSaved());

        $report->delete();
    }
}
