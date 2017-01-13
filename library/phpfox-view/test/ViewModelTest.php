<?php

namespace Phpfox\View;

class ViewModelTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $vm = new ViewModel();

        $this->assertNull($vm->getTemplate());

        $this->assertEmpty($vm->all());

        $vm->setTemplate('template1');

        $this->assertEquals('template1', $vm->getTemplate());

        $vm->assign(['k1' => 'v1', 'k2' => 'v2']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2'], $vm->all());

        $vm->assign(['k2' => 'v2.', 'k3' => 'v3']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2.', 'k3' => 'v3'],
            $vm->all());

        $vm->setTemplate('');

        $this->assertEquals('', $vm->render());

        $vm->terminate();
    }
}
