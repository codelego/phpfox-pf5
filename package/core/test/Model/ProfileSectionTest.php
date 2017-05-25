<?php
namespace Neutron\Core\Model;

class ProfileSectionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileSection(array (  'section_id' => 1,  'process_id' => 1,  'section_label' => 'Test',  'ordering' => 1,  'is_active' => 1,  'dependencies' => '[]',));

        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('Test', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getDependencies());    }

    public function testParameters()
    {
        $obj = new ProfileSection();

        // set data
        $obj->setSectionId(1);
        $obj->setProcessId(1);
        $obj->setSectionLabel('Test');
        $obj->setOrdering(1);
        $obj->setActive(1);
        $obj->setDependencies('[]');
        // assert same data
        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('Test', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getDependencies());    }

    public function testSave()
    {
        $obj = new ProfileSection(array (  'section_id' => 1,  'process_id' => 1,  'section_label' => 'Test',  'ordering' => 1,  'is_active' => 1,  'dependencies' => '[]',));

        $obj->save();

        /** @var ProfileSection $obj */
        $obj = _model('profile_section')
            ->select()->where('section_id=?',1)->first();

        $this->assertSame('profile_section', $obj->getModelId());
        $this->assertSame(1, $obj->getSectionId());
        $this->assertSame(1, $obj->getProcessId());
        $this->assertSame('Test', $obj->getSectionLabel());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('[]', $obj->getDependencies());    }

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