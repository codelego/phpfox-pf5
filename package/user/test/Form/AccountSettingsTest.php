<?php

namespace Neutron\User\Form;


use Phpfox\Form\FieldInterface;
use Phpfox\Form\FormRenderBootstrap;

class AccountSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AccountSettings();

        $this->assertTrue($form->getElement('username') instanceof
            FieldInterface);
        $this->assertTrue($form->getElement('password') instanceof
            FieldInterface);

        $this->assertNotEmpty((new FormRenderBootstrap())->render($form));
    }
}
