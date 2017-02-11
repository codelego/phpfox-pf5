<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormBootstrapRender;

class AuthorizationSettingsTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new AuthorizationSettings();

        $this->assertSame(true,
            $form->getElement('core__account_deletion') instanceof ElementInterface);

        $this->assertNotEmpty((new FormBootstrapRender())->render($form));
    }
}