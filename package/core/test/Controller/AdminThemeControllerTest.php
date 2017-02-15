<?php

namespace Neutron\Core\Controller;


use Phpfox\Action\Request;
use Phpfox\View\ViewModel;

class AdminThemeControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testActionIndexByCommandInActive()
    {
        Request::factory([
            'method' => 'get',
            'id'     => 'default',
            'cmd'    => 'inactive',
        ])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionIndexByCommandActive()
    {
        Request::factory([
            'method' => 'get',
            'id'     => 'default',
            'cmd'    => 'active',
        ])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionIndexByCommandDefault()
    {
        Request::factory([
            'method' => 'get',
            'id'     => 'default',
            'cmd'    => 'default',
        ])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionIndexByCommandRebuildFile()
    {
        Request::factory([
            'method' => 'get',
            'id'     => 'default',
            'cmd'    => 'rebuild-files',
        ])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function _testActionIndexByCommandRebuildMain()
    {
        Request::factory([
            'method' => 'get',
            'id'     => 'default',
            'cmd'    => 'rebuild-main',
        ])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionIndexByEmptyParams()
    {
        Request::factory(['method' => 'get'])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionDebugByEmpty()
    {
        Request::factory(['method' => 'get', 'id' => ''])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionDebug();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionDebugByAdminTheme()
    {
        Request::factory(['method' => 'get', 'id' => 'admin'])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionDebug();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionEditByEmptyParams()
    {
        Request::factory(['method' => 'get', 'id' => ''])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionEdit();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testActionEditByParams()
    {
        Request::factory(['method' => 'get', 'id' => 'galaxy'])
            ->singleton();

        $obj = new AdminThemeController();

        $vm = $obj->actionEdit();

        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }
}
