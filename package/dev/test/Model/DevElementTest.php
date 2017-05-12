<?php
namespace Neutron\Dev\Model;

class DevElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevElement(array (  'element_id' => 29,  'meta_id' => 569,  'element_name' => 'core__clear_cache',  'factory_id' => 'yesno',  'label' => 'Clear Cache',  'sort_order' => 1,  'is_active' => 1,  'note' => '',  'info' => '',));

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(29, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());    }

    public function testParameters()
    {
        $obj = new DevElement();

        // set data
        $obj->setElementId(29);
        $obj->setMetaId(569);
        $obj->setElementName('core__clear_cache');
        $obj->setFactoryId('yesno');
        $obj->setLabel('Clear Cache');
        $obj->setSortOrder(1);
        $obj->setActive(1);
        $obj->setNote('');
        $obj->setInfo('');
        // assert same data
        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(29, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());    }

    public function testSave()
    {
        $obj = new DevElement(array (  'element_id' => 29,  'meta_id' => 569,  'element_name' => 'core__clear_cache',  'factory_id' => 'yesno',  'label' => 'Clear Cache',  'sort_order' => 1,  'is_active' => 1,  'note' => '',  'info' => '',));

        $obj->save();

        /** @var DevElement $obj */
        $obj = _model('dev_element')
            ->select()->where('element_id=?',29)->first();

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(29, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());    }

    public static function setUpBeforeClass()
    {
        _model('dev_element')
            ->delete()->where('element_id=?',29)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_element')
            ->delete()->where('element_id=?',29)->execute();
    }
}