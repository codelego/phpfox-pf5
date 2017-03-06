<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\BootstrapFormRender;

class FilterI18nPhraseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new FilterI18nPhrase();

        $this->assertSame(true,
            $form->getElement('q') instanceof ElementInterface);

        $this->assertNotEmpty((new BootstrapFormRender())->render($form));
    }
}
