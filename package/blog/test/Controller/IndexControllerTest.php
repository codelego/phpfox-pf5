<?php

namespace Neutron\Blog\Controller;


use Phpfox\Support\Request;
use Phpfox\View\ViewModel;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testActionIndexWithHttpGetDefault()
    {
        Request::factory(['method' => 'get'])->singleton();

        $obj = new IndexController();

        $vm = $obj->actionIndex();

        $this->assertTrue($vm instanceof ViewModel);

        $this->assertNotNull($vm->render());
    }

    public function testActionAddWithHttpGetDefaultValue()
    {
        Request::factory(['method' => 'post'])
            ->singleton();

        $obj = new IndexController();

        $vm = $obj->actionAdd();
        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());

    }
}
