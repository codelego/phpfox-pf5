<?php

namespace Neutron\Core\Form;


class EditLayoutContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new EditLayoutContainer();
        $this->assertNotNull($form->getElement('page_id'));
        $this->assertNotNull($form->getElement('grid_id'));
        $this->assertNotNull($form->getElement('type_id'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('sort_order'));
    }
}
