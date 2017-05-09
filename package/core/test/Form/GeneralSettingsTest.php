<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormRenderBootstrap;

class GeneralSettingsTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new AdminSettingsCoreSite();

        $this->assertSame(true,
            $form->getElement('core__offline') instanceof ElementInterface);

        $this->assertNotEmpty((new FormRenderBootstrap())->render($form));
    }
}
