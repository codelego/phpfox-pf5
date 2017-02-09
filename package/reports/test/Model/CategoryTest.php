<?php

namespace Neutron\AbuseReport\Model;


class CategoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $entry = new Category();

        $entry->fromArray([
            'is_active' => 1,
            'name'      => 'category name',
        ]);

        $this->assertFalse($entry->isSaved());

        $entry->save();
        $this->assertTrue($entry->isActive());
        $this->assertEquals('category name', $entry->getName());
        $this->assertEquals('category name', $entry->getTitle());

        $this->assertTrue($entry->isSaved());

        $entry->delete();
    }

    public function testBase2()
    {
        $entry = new Category();

        $entry->setName('category name');
        $entry->setTitle('category name');
        $entry->setActive(false);

        $this->assertFalse($entry->isSaved());

        $entry->save();
        $this->assertFalse($entry->isActive());
        $this->assertEquals('category name', $entry->getName());
        $this->assertEquals('category name', $entry->getTitle());

        $this->assertTrue($entry->isSaved());

        $entry->delete();
    }
}
