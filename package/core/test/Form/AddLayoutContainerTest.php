<?php

namespace Neutron\Core\Form;


class AddLayoutContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutContainer();
        $this->assertNotNull($form->getElement('page_id'));
        $this->assertNotNull($form->getElement('grid_id'));
        $this->assertNotNull($form->getElement('type_id'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('sort_order'));
    }
}
