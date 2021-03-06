<?php

namespace Neutron\Report\Model;

class ReportCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ReportCategory(['category_id' => 1, 'is_active' => 0, 'name' => 'It\'s annoying or not interesting', 'description' => '',]);

        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('It's annoying or not interesting', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new ReportCategory();

        // set data
        $obj->setCategoryId(1);
        $obj->setActive(0);
        $obj->setName('It's annoying or not interesting');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('It's annoying or not interesting', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new ReportCategory(array (  'category_id' => 1,  'is_active' => 0,  'name' => 'It\'s annoying or not interesting',  'description' => '',));

        $obj->save();

        /** @var ReportCategory $obj */
        $obj = \Phpfox::model('report_category')
            ->select()->where('category_id=?', 1)->first();

        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('It's annoying or not interesting', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('report_category')
            ->delete()->where('category_id =?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('report_category')
            ->delete()->where('category_id =?',1)->execute();
    }
}