<?php

namespace Neutron\Video\Controller;


use Phpfox\View\ViewModel;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $obj = new IndexController();

        $vm = $obj->actionIndex();
        $this->assertEquals(true, $vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }

    public function testEmbed()
    {
        $obj = new IndexController();

        $vm = $obj->actionEmbed();
        $this->assertEquals(true, $vm instanceof ViewModel);
        $this->assertNotEmpty($vm->render());
    }
}
