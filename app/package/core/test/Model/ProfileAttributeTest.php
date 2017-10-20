<?php
namespace Neutron\Core\Model;

class ProfileAttributeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ProfileAttribute(array (  'attribute_id' => 1,  'item_type' => 'user',  'attribute_name' => 'username',  'factory_id' => 'text',  'attribute_label' => 'Username',  'placeholder' => NULL,  'note' => NULL,  'info' => NULL,  'is_basic' => 1,  'is_require' => 1,  'ordering' => 1,  'options' => '',  'is_system' => 0,  'is_active' => 1,));

        $this->assertSame('profile_attribute', $obj->getModelId());
        $this->assertSame(1, $obj->getAttributeId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getAttributeName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getAttributeLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame(1, $obj->isBasic());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame(0, $obj->isSystem());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new ProfileAttribute();

        // set data
        $obj->setAttributeId(1);
        $obj->setItemType('user');
        $obj->setAttributeName('username');
        $obj->setFactoryId('text');
        $obj->setAttributeLabel('Username');
        $obj->setPlaceholder('');
        $obj->setNote('');
        $obj->setInfo('');
        $obj->setBasic(1);
        $obj->setRequire(1);
        $obj->setOrdering(1);
        $obj->setOptions('');
        $obj->setSystem(0);
        $obj->setActive(1);
        // assert same data
        $this->assertSame('profile_attribute', $obj->getModelId());
        $this->assertSame(1, $obj->getAttributeId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getAttributeName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getAttributeLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame(1, $obj->isBasic());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame(0, $obj->isSystem());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new ProfileAttribute(array (  'attribute_id' => 1,  'item_type' => 'user',  'attribute_name' => 'username',  'factory_id' => 'text',  'attribute_label' => 'Username',  'placeholder' => NULL,  'note' => NULL,  'info' => NULL,  'is_basic' => 1,  'is_require' => 1,  'ordering' => 1,  'options' => '',  'is_system' => 0,  'is_active' => 1,));

        $obj->save();

        /** @var ProfileAttribute $obj */
        $obj = _model('profile_attribute')
            ->select()->where('attribute_id=?',1)->first();

        $this->assertSame('profile_attribute', $obj->getModelId());
        $this->assertSame(1, $obj->getAttributeId());
        $this->assertSame('user', $obj->getItemType());
        $this->assertSame('username', $obj->getAttributeName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame('Username', $obj->getAttributeLabel());
        $this->assertSame('', $obj->getPlaceholder());
        $this->assertSame('', $obj->getNote());
        $this->assertSame('', $obj->getInfo());
        $this->assertSame(1, $obj->isBasic());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame(1, $obj->getOrdering());
        $this->assertSame('', $obj->getOptions());
        $this->assertSame(0, $obj->isSystem());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('profile_attribute')
            ->delete()->where('attribute_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('profile_attribute')
            ->delete()->where('attribute_id=?',1)->execute();
    }
}