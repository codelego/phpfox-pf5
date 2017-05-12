<?php
namespace Neutron\Dev\Model;

class DevElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevElement(array (  'element_id' => 1,  'meta_id' => 569,  'is_identity' => 0,  'is_primary' => NULL,  'element_name' => 'core__clear_cache',  'factory_id' => 'yesno',  'label' => 'Clear Cache',  'sort_order' => 1,  'is_active' => 1,  'default_value' => NULL,  'note' => '[Clear Cache Note]',  'info' => '[Clear Cache Info]',  'placeholder' => '',  'max_length' => NULL,  'rows' => NULL,  'cols' => NULL,  'is_require' => 1,  'is_readonly' => 1,  'is_disabled' => 1,  'class_name' => '',  'data_cmd' => '',));

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(1, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame(0, $obj->isIdentity());
        $this->assertSame('', $obj->isPrimary());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Clear Cache Note]', $obj->getNote());
        $this->assertSame('[Clear Cache Info]', $obj->getInfo());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->isReadonly());
        $this->assertSame(1, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame('', $obj->getDataCmd());    }

    public function testParameters()
    {
        $obj = new DevElement();

        // set data
        $obj->setElementId(1);
        $obj->setMetaId(569);
        $obj->setIdentity(0);
        $obj->setPrimary('');
        $obj->setElementName('core__clear_cache');
        $obj->setFactoryId('yesno');
        $obj->setLabel('Clear Cache');
        $obj->setSortOrder(1);
        $obj->setActive(1);
        $obj->setDefaultValue('');
        $obj->setNote('[Clear Cache Note]');
        $obj->setInfo('[Clear Cache Info]');
        $obj->setPlaceholder('');
        $obj->setMaxLength('');
        $obj->setRows('');
        $obj->setCols('');
        $obj->setRequire(1);
        $obj->setReadonly(1);
        $obj->setDisabled(1);
        $obj->setClassName('');
        $obj->setDataCmd('');
        // assert same data
        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(1, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame(0, $obj->isIdentity());
        $this->assertSame('', $obj->isPrimary());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Clear Cache Note]', $obj->getNote());
        $this->assertSame('[Clear Cache Info]', $obj->getInfo());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->isReadonly());
        $this->assertSame(1, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame('', $obj->getDataCmd());    }

    public function testSave()
    {
        $obj = new DevElement(array (  'element_id' => 1,  'meta_id' => 569,  'is_identity' => 0,  'is_primary' => NULL,  'element_name' => 'core__clear_cache',  'factory_id' => 'yesno',  'label' => 'Clear Cache',  'sort_order' => 1,  'is_active' => 1,  'default_value' => NULL,  'note' => '[Clear Cache Note]',  'info' => '[Clear Cache Info]',  'placeholder' => '',  'max_length' => NULL,  'rows' => NULL,  'cols' => NULL,  'is_require' => 1,  'is_readonly' => 1,  'is_disabled' => 1,  'class_name' => '',  'data_cmd' => '',));

        $obj->save();

        /** @var DevElement $obj */
        $obj = _model('dev_element')
            ->select()->where('element_id=?',1)->first();

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(1, $obj->getElementId());
        $this->assertSame(569, $obj->getMetaId());
        $this->assertSame(0, $obj->isIdentity());
        $this->assertSame('', $obj->isPrimary());
        $this->assertSame('core__clear_cache', $obj->getElementName());
        $this->assertSame('yesno', $obj->getFactoryId());
        $this->assertSame('Clear Cache', $obj->getLabel());
        $this->assertSame(1, $obj->getSortOrder());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Clear Cache Note]', $obj->getNote());
        $this->assertSame('[Clear Cache Info]', $obj->getInfo());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->isReadonly());
        $this->assertSame(1, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame('', $obj->getDataCmd());    }

    public static function setUpBeforeClass()
    {
        _model('dev_element')
            ->delete()->where('element_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('dev_element')
            ->delete()->where('element_id=?',1)->execute();
    }
}