<?php

namespace Neutron\Core\Form;


class EditLayoutBlockTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new EditLayoutBlock();
        $this->assertNotNull($form->getElement('container_id'));
        $this->assertNotNull($form->getElement('location_id'));
        $this->assertNotNull($form->getElement('component_id'));
        $this->assertNotNull($form->getElement('sort_order'));
        $this->assertNotNull($form->getElement('is_active'));
    }
}
