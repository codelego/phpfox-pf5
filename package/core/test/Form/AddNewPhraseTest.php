<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ElementInterface;
use Phpfox\Form\FormBootstrapRender;

class AddNewPhraseTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new AddNewPhrase();

        $this->assertSame(true,
            $form->getElement('var_name') instanceof ElementInterface);

        $this->assertNotEmpty((new FormBootstrapRender())->render($form));
    }
}