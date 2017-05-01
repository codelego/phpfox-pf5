<?php

namespace Neutron\Core\Form;


class AddLayoutComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutComponent();
        $this->assertNotNull($form->getElement('component_id'));
        $this->assertNotNull($form->getElement('component_name'));
        $this->assertNotNull($form->getElement('component_class'));
        $this->assertNotNull($form->getElement('form_name'));
        $this->assertNotNull($form->getElement('package_id'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('sort_order'));
        $this->assertNotNull($form->getElement('description'));
    }
}
