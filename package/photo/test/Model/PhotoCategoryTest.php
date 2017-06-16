<?php
namespace Neutron\Photo\Model;

class PhotoCategoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new PhotoCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Anthro',  'description' => NULL,));

        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Anthro', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testParameters()
    {
        $obj = new PhotoCategory();

        // set data
        $obj->setCategoryId(1);
        $obj->setActive(1);
        $obj->setName('Anthro');
        $obj->setDescription('');
        // assert same data
        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Anthro', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public function testSave()
    {
        $obj = new PhotoCategory(array (  'category_id' => 1,  'is_active' => 1,  'name' => 'Anthro',  'description' => NULL,));

        $obj->save();

        /** @var PhotoCategory $obj */
        $obj = _model('photo_category')
            ->select()->where('category_id=?',1)->first();

        $this->assertSame('photo_category', $obj->getModelId());
        $this->assertSame(1, $obj->getCategoryId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('Anthro', $obj->getName());
        $this->assertSame('', $obj->getDescription());    }

    public static function setUpBeforeClass()
    {
        _model('photo_category')
            ->delete()->where('category_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('photo_category')
            ->delete()->where('category_id=?',1)->execute();
    }
}