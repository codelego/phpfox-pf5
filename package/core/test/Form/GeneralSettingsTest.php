<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormBootstrapRender;

class GeneralSettingsTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new GeneralSettings();

        $this->assertSame(true,
            $form->getElement('core__offline') instanceof ElementInterface);

        $this->assertNotEmpty((new FormBootstrapRender())->render($form));
    }
}
