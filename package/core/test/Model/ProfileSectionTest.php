<?php
namespace Neutron\Core\Model;

class ProfileSectionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileSection(array (  'section_id' => 1,  'item_type' => 'user',  'section_name' => 'info',  'section_label' => 'Basic Information',  'ordering' => 1,));

        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('info', $obj->getSectionName());
        $this->assertSame('Basic Information', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());    }

    public function testParameters()
    {
        $obj = new ProfileSection();

        // set data
        $obj->setSectionId(1);
        $obj->setItemType('user');
        $obj->setSectionName('info');
        $obj->setSectionLabel('Basic Information');
        $obj->setOrdering(1);
        // assert same data
        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('info', $obj->getSectionName());
        $this->assertSame('Basic Information', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());    }

    public function testSave()
    {
        $obj = new ProfileSection(array (  'section_id' => 1,  'item_type' => 'user',  'section_name' => 'info',  'section_label' => 'Basic Information',  'ordering' => 1,));

        $obj->save();

        /** @var ProfileSection $obj */
        $obj = _model('profile_section')
            ->select()->where('section_id=?',1)->first();

        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('info', $obj->getSectionName());
        $this->assertSame('Basic Information', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());    }

    public static function setUpBeforeClass()
    {
        _model('profile_section')
            ->delete()->where('section_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_section')
            ->delete()->where('section_id=?',1)->execute();
    }
}