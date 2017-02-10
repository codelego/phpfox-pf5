<?php

namespace Neutron\Blog\Model;


class CategoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new Category([
            'category_id' => 3,
            'name'        => '[example category name]',
            'description' => '[example category description]',
            'is_active'   => 1,
        ]);

        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example category name]', $obj->getName());
        $this->assertSame('[example category name]', $obj->getTitle());
        $this->assertSame('[example category description]',
            $obj->getDescription());
    }

    public function testBase2()
    {
        $obj = new Category([
            'category_id' => 3,
            'name'        => '[example category name]',
            'description' => '[example category description]',
            'is_active'   => 1,
        ]);

        $obj->setId(3);
        $obj->setActive(1);
        $obj->setName('[example category name]');
        $obj->setDescription('[example category description]');

        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[example category name]', $obj->getName());
        $this->assertSame('[example category name]', $obj->getTitle());
        $this->assertSame('[example category description]',
            $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new Category([
            'name'        => '[example category name]',
            'description' => '[example category description]',
            'is_active'   => 0,
        ]);

        $obj->save();

        /** @var Category $obj */
        $obj = \Phpfox::with('blog_category')
            ->select()
            ->where('name=?', '[example category name]')
            ->first();

        $this->assertNotNull($obj);

        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('[example category name]', $obj->getName());
        $this->assertSame('[example category name]', $obj->getTitle());
        $this->assertSame('[example category description]',
            $obj->getDescription());

    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')->delete(':blog_category')
            ->where('name=?', '[example category name]')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')->delete(':blog_category')
            ->where('name=?', '[example category name]')
            ->execute();
    }
}
