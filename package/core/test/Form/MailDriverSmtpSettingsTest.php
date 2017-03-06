<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ElementInterface;
use Phpfox\Form\BootstrapFormRender;

class MailDriverSmtpSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new MailDriverSmtpSettings();

        $this->assertSame(true,
            $form->getElement('license_email') instanceof ElementInterface);

        $this->assertNotEmpty((new BootstrapFormRender())->render($form));
    }
}
