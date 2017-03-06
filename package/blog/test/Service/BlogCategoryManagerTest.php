<?php

namespace Neutron\Blog\Service;


use Neutron\Blog\Model\BlogCategory;

class BlogCategoryManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return BlogCategory
     */
    public function testInsertCategory()
    {
        $obj = new BlogCategory([
            'name'        => 'example name ' . microtime(),
            'is_active'   => 1,
            'description' => '[example description]',
        ]);

        $obj->save();

        $this->assertNotEmpty($obj->getId());

        return $obj;

    }

    /**
     *
     * @depends  testInsertCategory
     *
     * @param BlogCategory $obj
     *
     * @return BlogCategory
     */
    public function testHasName($obj)
    {
        $mn = new BlogCategoryManager();
        $this->assertTrue($mn->hasName($obj->getName()));

        return $obj;
    }

    /**
     * @depends  testHasName
     *
     * @param BlogCategory $category
     *
     * @return   BlogCategory
     */
    public function testFindByName($category)
    {
        $obj = new BlogCategoryManager();

        $this->assertNotEmpty($category->getId());
        $this->assertSame($category->getId(),
            $obj->findIdByName($category->getName()));
        return $category;
    }

    /**
     * @depends  testFindByName
     *
     * @param BlogCategory $category
     *
     * @return BlogCategory
     */
    public function testDeleteCategory($category)
    {
        $category->delete();
        $mn = new BlogCategoryManager();
        $this->assertFalse($mn->hasName($category->getName()));
        $this->assertSame(0, $mn->findIdByName($category->getName()));
    }
}
