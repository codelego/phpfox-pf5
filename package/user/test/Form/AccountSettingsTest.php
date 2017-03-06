<?php

namespace Neutron\User\Form;


use Phpfox\Form\FieldInterface;
use Phpfox\Form\BootstrapFormRender;

class AccountSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AccountSettings();

        $this->assertTrue($form->getElement('username') instanceof
            FieldInterface);
        $this->assertTrue($form->getElement('password') instanceof
            FieldInterface);

        $this->assertNotEmpty((new BootstrapFormRender())->render($form));
    }
}
