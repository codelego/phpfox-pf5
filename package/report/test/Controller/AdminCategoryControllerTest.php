<?php

namespace Neutron\Report\Controller;


use Neutron\Report\Model\ReportCategory;
use Phpfox\Action\Request;
use Phpfox\View\ViewModel;

class AdminCategoryControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminCategoryController();

        $vm = $obj->actionIndex();
        $this->assertTrue($vm instanceof ViewModel);

        $this->assertNotEmpty($vm->render());
    }

    public function testAdd01()
    {
        $request = Request::factory([
            'method' => 'get',
        ]);

        _get('manager')
            ->set('request', $request);

        $obj = new AdminCategoryController();
        $vm = $obj->actionAdd();

        $this->assertTrue($vm instanceof ViewModel);

        $this->assertNotEmpty($vm->render());
    }

    public function testAdd02()
    {
        $request = Request::factory([
            'method'      => 'post',
            'name'        => '[example name]',
            'description' => '',
            'is_active'   => 0,
        ]);

        _get('manager')
            ->set('request', $request);

        $obj = new AdminCategoryController();

        $vm = $obj->actionAdd();

        $this->assertTrue($vm instanceof ViewModel);

        $this->assertNotEmpty($vm->render());

        // test lat object

        /** @var ReportCategory $obj */
        $obj = _with('report_category')
            ->select('*')
            ->where('is_active=?', 0)->where('name=?', '[example name]')
            ->setPrototype(ReportCategory::class)
            ->first();

        $this->assertEquals(true, $obj instanceof ReportCategory);

        $obj->delete();
    }
}
