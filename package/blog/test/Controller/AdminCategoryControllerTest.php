<?php

namespace Neutron\Blog\Controller;


use Phpfox\Action\Request;
use Phpfox\View\ViewModel;

class AdminCategoryControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testActionIndexWithDefaultValue()
    {
        $request = Request::factory([
            'method' => 'get',
        ]);

        _get('manager')->set('request', $request);

        $obj = new AdminCategoryController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());

    }

    public function testActionAddWithHttpGet()
    {
        $request = Request::factory([
            'method' => 'get',
        ]);

        _get('manager')->set('request', $request);

        $obj = new AdminCategoryController();

        $vm = $obj->actionAdd();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());
    }

    public function testActionAddWithHttpPost()
    {
        $request = Request::factory([
            'method'      => 'post',
            'name'        => 'category name ' . time(),
            'description' => '[example description]',
            'is_active'   => mt_rand(0, 1),
        ]);

        _get('manager')->set('request', $request);

        $obj = new AdminCategoryController();

        $vm = $obj->actionAdd();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());
    }
}
