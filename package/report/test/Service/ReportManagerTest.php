<?php

namespace Neutron\Report\Service;


use Neutron\Report\Model\Report;
use Neutron\Report\Model\ReportCategory;

class ReportManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new Report([
            'category_id' => 3,
            'message'     => 'message content',
            'user_id'     => 100,
            'about_id'    => 21,
            'about_type'  => 'user',
            'created_at'  => '2012-10-10 00:22:44',
        ]);

        $obj->save();

        $mn = new ReportManager();

        $obj2 = $mn->findReportById($obj->getId());

        $this->assertTrue($obj2 instanceof Report);
        $this->assertSame($obj->getId(), $obj2->getId());

        $this->assertNull($mn->findReportById(0));

        $mn->deleteReport($obj->getId());

        $this->assertNull($mn->findReportById($obj->getId()));
    }

    public function testFindCategoryById()
    {
        $obj = new ReportCategory([
            'is_active'   => 1,
            'name'        => 'It\'s a fake news story',
            'description' => '[example category]',
        ]);
        $obj->save();

        $mn = new ReportManager();

        $obj2 = $mn->findCategoryById($obj->getId());

        $this->assertTrue($obj2 instanceof ReportCategory);
        $this->assertSame($obj->getId(), $obj2->getId());

        $this->assertNull($mn->findCategoryById(0));
    }

    public function testGetActiveCategoryOptions()
    {
        $mn = new ReportManager();

        _service('cache.local')
            ->deleteItem('AbuseReport.getActiveCategoryOptions');

        $data = $mn->_getActiveCategoryOptions();
        $data2 = $mn->getActiveCategoryOptions();

        $this->assertSame($data, $data2);
    }
}
