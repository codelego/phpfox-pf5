<?php

namespace Phpfox\View;

class ViewModelTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $vm = new ViewModel();

        $this->assertNull($vm->getTemplate());

        $this->assertEmpty($vm->getVariables());

        $vm->setTemplate('template1');

        $this->assertEquals('template1', $vm->getTemplate());

        $vm->setVariables(['k1' => 'v1', 'k2' => 'v2']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2'], $vm->getVariables());

        $vm->assign(['k2' => 'v2.', 'k3' => 'v3']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2.', 'k3' => 'v3'],
            $vm->getVariables());

        $vm->setTemplate('');

        $this->assertEquals('', $vm->render());

        $vm->terminate();
    }
}
