<?php

namespace Phpfox\Assets;


class BreadcrumbTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Breadcrumb();

        $this->assertEmpty($obj->getHtml());

        $obj->add([
            'label'       => 'Add label',
            'href'        => '',
            'data-toggle' => '',
        ]);

        $obj->clear();
        $this->assertEmpty($obj->getHtml());
    }
}
