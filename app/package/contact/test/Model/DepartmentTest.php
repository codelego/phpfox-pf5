<?php

namespace Neutron\Contact\Model;


class DepartmentTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Department();

        $obj->setActive(false);
        $obj->setDefault(false);
        $obj->setTitle('department name');
        $obj->setName('department name');
        $obj->setDescription('department description');

        $obj->save();

        $this->assertEquals(false, $obj->isActive());
        $this->assertEquals(false, $obj->isDefault());
        $this->assertEquals('department name', $obj->getTitle());
        $this->assertEquals('department name', $obj->getName());
        $this->assertEquals('department description', $obj->getDescription());

        $this->assertEquals(true, $obj->isSaved());

        $obj->delete();
    }
}
