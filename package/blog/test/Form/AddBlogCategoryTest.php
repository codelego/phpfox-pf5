<?php

namespace Neutron\Blog\Form;


class AddBlogCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddBlogCategory();
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('name'));
        $this->assertNotNull($form->getElement('description'));
    }
}
