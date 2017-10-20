<?php

namespace Neutron\Blog\Form;


class EditBlogCategoryTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $form = new EditBlogCategory();
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('name'));
        $this->assertNotNull($form->getElement('description'));
    }
}
