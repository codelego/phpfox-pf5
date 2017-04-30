<?php

namespace Neutron\Report\Model;

class ReportCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ReportCategory([
            'category_id' => 1,
            'is_active'   => 1,
            'name'        => 'It\'s annoying or not interesting',
            'description' => '[description]',
        ]);

        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('It\'s annoying or not interesting', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testParameters()
    {
        $obj = new ReportCategory();

        // set data
        $obj->setId(1);
        $obj->setActive(1);
        $obj->setName('It\'s annoying or not interesting');
        $obj->setDescription('[description]');

        // assert same data
        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('It\'s annoying or not interesting', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new ReportCategory([
            'category_id' => 1,
            'is_active'   => 1,
            'name'        => 'It\'s annoying or not interesting',
            'description' => '[description]',
        ]);

        $obj->save();

        /** @var ReportCategory $obj */
        $obj = \Phpfox::with('report_category')
            ->select()
            ->where('category_id=?', 1)->first();

        $this->assertSame('report_category', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('It\'s annoying or not interesting', $obj->getName());
        $this->assertSame('[description]', $obj->getDescription());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('report_category')
            ->delete()->where('category_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('report_category')
            ->delete()->where('category_id=?', 1)->execute();
    }
}