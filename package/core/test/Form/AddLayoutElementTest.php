<?php

namespace Neutron\Core\Form;


class AddLayoutElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutElement();
        $this->assertNotNull($form->getElement('page_id'));
        $this->assertNotNull($form->getElement('theme_id'));
        $this->assertNotNull($form->getElement('block_id'));
        $this->assertNotNull($form->getElement('location_id'));
        $this->assertNotNull($form->getElement('sort_order'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('params'));
    }
}
