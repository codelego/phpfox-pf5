<?php

namespace Neutron\Core\Form;


class AddLayoutPageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutPage();
        $this->assertNotNull($form->getElement('page_id'));
        $this->assertNotNull($form->getElement('parent_page_id'));
        $this->assertNotNull($form->getElement('page_name'));
        $this->assertNotNull($form->getElement('package_id'));
        $this->assertNotNull($form->getElement('description'));
    }
}
