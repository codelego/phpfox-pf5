<?php

namespace Neutron\Report\Form;


use Phpfox\Form\FormRenderBootstrap;

class AddAbuseReportTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddAbuseReport();

        $render = new FormRenderBootstrap();

        $content = $render->render($form);

        $this->assertNotEmpty($form->getElement('category_id'));
        $this->assertNotEmpty($form->getElement('about_type'));
        $this->assertNotEmpty($form->getElement('about_id'));
        $this->assertNotEmpty($form->getElement('message'));

        $this->assertNotEmpty($content);
    }
}
