<?php

namespace Neutron\User\Form;


use Phpfox\Form\FieldInterface;
use Phpfox\Form\FormRenderBootstrap;

class AdminFilterUserTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AdminFilterUser();

        $this->assertTrue($form->getElement('q') instanceof
            FieldInterface);
        $this->assertTrue($form->getElement('role_id') instanceof
            FieldInterface);
        $this->assertTrue($form->getElement('verify') instanceof
            FieldInterface);

        $this->assertNotEmpty((new FormRenderBootstrap())->render($form));
    }
}
