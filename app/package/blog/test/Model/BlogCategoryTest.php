<?php
namespace Neutron\Blog\Model;

class BlogCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new BlogCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Business',  'description' => NULL,));

        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Business', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new BlogCategory();

        // set data
        $obj->setCategoryId(1);
        $obj->setActive(1);
        $obj->setName('Business');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Business', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new BlogCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Business',  'description' => NULL,));

        $obj->save();

        /** @var BlogCategory $obj */
        $obj = _model('blog_category')
            ->select()->where('category_id=?',1)->first();

        $this->assertSame('blog_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Business', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('blog_category')
            ->delete()->where('category_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('blog_category')
            ->delete()->where('category_id=?',1)->execute();
    }
}