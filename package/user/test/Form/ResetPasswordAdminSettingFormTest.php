<?php

namespace Neutron\User\Form;


class ResetPasswordAdminSettingFormTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form  = new ResetPasswordAdminSettingForm();

        $this->assertNotEmpty($form->render());
    }
}
