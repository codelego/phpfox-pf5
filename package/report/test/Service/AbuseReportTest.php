<?php
namespace Neutron\Report\Service;

use Neutron\Report\Model\Report;

class AbuseReportTest extends \PHPUnit_Framework_TestCase
{

    public function testAdd()
    {
        $obj = new ReportManager();

        /** @var Report $report */
        $report = $obj->addReport([
            'message'    => 'message content',
            'created_at' => '2016-10-12 00:00:00',
            'user_id'    => 100,
            'about_type' => 'user',
            'about_id'   => 21,
        ]);

        $this->assertTrue($report instanceof Report);
        $this->assertEquals('message content', $report->getMessage());
        $this->assertEquals(100, $report->getUserId());
        $this->assertEquals('user', $report->getAboutType());
        $this->assertEquals('21', $report->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $report->getCreatedAt());
        $this->assertEquals(0, $report->getCategoryId());

        $this->assertTrue($report->isSaved());

        $report->delete();
    }

    public function testModel()
    {
        $report = new Report();

        $report->fromArray([
            'message'    => 'message content',
            'created_at' => '2016-10-12 00:00:00',
            'user_id'    => 100,
            'about_type' => 'user',
            'about_id'   => 21,
        ]);

        $report->save();

        $this->assertEquals('message content', $report->getMessage());
        $this->assertEquals(100, $report->getUserId());
        $this->assertEquals('user', $report->getAboutType());
        $this->assertEquals('21', $report->getAboutId());
        $this->assertEquals('2016-10-12 00:00:00', $report->getCreatedAt());
        $this->assertEquals(0, $report->getCategoryId());

        $this->assertTrue($report->isSaved());

        $report->delete();
    }
}
