<?php

namespace Neutron\Core\Form;


class AddLayoutActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutAction();
        $this->assertNotNull($form->getElement('action_id'));
        $this->assertNotNull($form->getElement('parent_action_id'));
        $this->assertNotNull($form->getElement('action_name'));
        $this->assertNotNull($form->getElement('package_id'));
        $this->assertNotNull($form->getElement('description'));
    }
}
