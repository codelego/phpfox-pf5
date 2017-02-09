<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormBootstrapRender;

class LicenseSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new LicenseSettings();

        $this->assertSame(true,
            $form->getElement('license_email') instanceof ElementInterface);

        $this->assertNotEmpty((new FormBootstrapRender())->render($form));
    }
}
