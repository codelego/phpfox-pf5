<?php

namespace Neutron\Core\Form;


class EditLayoutBlockTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new EditLayoutBlock();
        $this->assertNotNull($form->getElement('block_id'));
        $this->assertNotNull($form->getElement('block_name'));
        $this->assertNotNull($form->getElement('block_class'));
        $this->assertNotNull($form->getElement('form_class'));
        $this->assertNotNull($form->getElement('package_id'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('description'));
    }
}
