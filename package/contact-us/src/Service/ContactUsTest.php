<?php

namespace Neutron\ContactUs\Service;


class ContactUsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ContactUs();

        $entry = $obj->findDepartmentById(1);

        $this->assertNotEmpty($entry);

        $this->assertEquals(true, $entry->isActive());
        $this->assertEquals(true, $entry->isDefault());

        $this->assertEquals(1, $obj->getDefaultDepartmentId());

        $this->assertNotEmpty($obj->getActiveDepartmentOptions());
    }
}
