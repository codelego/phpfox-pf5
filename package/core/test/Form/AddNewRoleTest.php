<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\BootstrapFormRender;

class AddNewRoleTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new AddNewRole();

        $this->assertSame(true,
            $form->getElement('name') instanceof ElementInterface);

        $this->assertSame(true,
            $form->getElement('inherit_id') instanceof ElementInterface);

        $this->assertNotEmpty((new BootstrapFormRender())->render($form));
    }
}
