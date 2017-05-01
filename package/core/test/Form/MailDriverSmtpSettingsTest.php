<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormRenderBootstrap;

class MailDriverSmtpSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new MailDriverSmtpSettings();

        $this->assertSame(true,
            $form->getElement('license_email') instanceof ElementInterface);

        $this->assertNotEmpty((new FormRenderBootstrap())->render($form));
    }
}
