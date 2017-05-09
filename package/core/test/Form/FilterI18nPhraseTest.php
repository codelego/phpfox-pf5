<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormRenderBootstrap;

class FilterI18nPhraseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new FilterI18nMessage();

        $this->assertSame(true,
            $form->getElement('q') instanceof ElementInterface);

        $this->assertNotEmpty((new FormRenderBootstrap())->render($form));
    }
}
