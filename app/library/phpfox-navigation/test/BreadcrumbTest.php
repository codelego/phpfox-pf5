<?php

namespace Phpfox\Navigation;


class BreadcrumbTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Breadcrumb();

        $this->assertEmpty($obj->render());

        $obj->add([
            'label'       => 'Add label',
            'href'        => '',
            'data-toggle' => '',
        ]);

        $obj->clear();
        $this->assertEmpty($obj->render());
    }
}
