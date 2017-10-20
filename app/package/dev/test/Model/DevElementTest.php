<?php

namespace Neutron\Dev\Model;

class DevElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DevElement(['element_id'     => 15,
                               'element_name'   => 'id',
                               'factory_id'     => 'text',
                               'is_require'     => 1,
                               'label'          => 'Id',
                               'ordering'       => 7,
                               'is_active'      => 1,
                               'default_value'  => '',
                               'note'           => '[Id Note]',
                               'info'           => '[Id Info]',
                               'info_domain'    => null,
                               'text_domain'    => null,
                               'placeholder'    => 'Id',
                               'max_length'     => null,
                               'rows'           => null,
                               'cols'           => null,
                               'is_readonly'    => 0,
                               'is_disabled'    => 0,
                               'class_name'     => '',
                               'is_primary'     => 1,
                               'is_identity'    => 1,
                               'data_cmd'       => '',
                               'meta_id'        => 9,
                               'primary_length' => 1,
                               'options_text'   => null,
                               'note_domain'    => null,
                               'has_note'       => 0,
                               'has_info'       => 0,
        ]);

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(15, $obj->getElementId());
        $this->assertSame('id', $obj->getElementName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Id', $obj->getLabel());
        $this->assertSame(7, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Id Note]', $obj->getNote());
        $this->assertSame('[Id Info]', $obj->getInfo());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('Id', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(0, $obj->isReadonly());
        $this->assertSame(0, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame(1, $obj->isPrimary());
        $this->assertSame(1, $obj->isIdentity());
        $this->assertSame('', $obj->getDataCmd());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame(1, $obj->getPrimaryLength());
        $this->assertSame('', $obj->getOptionsText());
        $this->assertSame('', $obj->getNoteDomain());
        $this->assertSame(0, $obj->getHasNote());
        $this->assertSame(0, $obj->getHasInfo());
    }

    public function testParameters()
    {
        $obj = new DevElement();

        // set data
        $obj->setElementId(15);
        $obj->setElementName('id');
        $obj->setFactoryId('text');
        $obj->setRequire(1);
        $obj->setLabel('Id');
        $obj->setOrdering(7);
        $obj->setActive(1);
        $obj->setDefaultValue('');
        $obj->setNote('[Id Note]');
        $obj->setInfo('[Id Info]');
        $obj->setInfoDomain('');
        $obj->setTextDomain('');
        $obj->setPlaceholder('Id');
        $obj->setMaxLength('');
        $obj->setRows('');
        $obj->setCols('');
        $obj->setReadonly(0);
        $obj->setDisabled(0);
        $obj->setClassName('');
        $obj->setPrimary(1);
        $obj->setIdentity(1);
        $obj->setDataCmd('');
        $obj->setMetaId(9);
        $obj->setPrimaryLength(1);
        $obj->setOptionsText('');
        $obj->setNoteDomain('');
        $obj->setHasNote(0);
        $obj->setHasInfo(0);
        // assert same data
        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(15, $obj->getElementId());
        $this->assertSame('id', $obj->getElementName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Id', $obj->getLabel());
        $this->assertSame(7, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Id Note]', $obj->getNote());
        $this->assertSame('[Id Info]', $obj->getInfo());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('Id', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(0, $obj->isReadonly());
        $this->assertSame(0, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame(1, $obj->isPrimary());
        $this->assertSame(1, $obj->isIdentity());
        $this->assertSame('', $obj->getDataCmd());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame(1, $obj->getPrimaryLength());
        $this->assertSame('', $obj->getOptionsText());
        $this->assertSame('', $obj->getNoteDomain());
        $this->assertSame(0, $obj->getHasNote());
        $this->assertSame(0, $obj->getHasInfo());
    }

    public function testSave()
    {
        $obj = new DevElement(['element_id'     => 15,
                               'element_name'   => 'id',
                               'factory_id'     => 'text',
                               'is_require'     => 1,
                               'label'          => 'Id',
                               'ordering'       => 7,
                               'is_active'      => 1,
                               'default_value'  => '',
                               'note'           => '[Id Note]',
                               'info'           => '[Id Info]',
                               'info_domain'    => null,
                               'text_domain'    => null,
                               'placeholder'    => 'Id',
                               'max_length'     => null,
                               'rows'           => null,
                               'cols'           => null,
                               'is_readonly'    => 0,
                               'is_disabled'    => 0,
                               'class_name'     => '',
                               'is_primary'     => 1,
                               'is_identity'    => 1,
                               'data_cmd'       => '',
                               'meta_id'        => 9,
                               'primary_length' => 1,
                               'options_text'   => null,
                               'note_domain'    => null,
                               'has_note'       => 0,
                               'has_info'       => 0,
        ]);

        $obj->save();

        /** @var DevElement $obj */
        $obj = \Phpfox::model('dev_element')
            ->select()->where('element_id=?', 15)->first();

        $this->assertSame('dev_element', $obj->getModelId());
        $this->assertSame(15, $obj->getElementId());
        $this->assertSame('id', $obj->getElementName());
        $this->assertSame('text', $obj->getFactoryId());
        $this->assertSame(1, $obj->isRequire());
        $this->assertSame('Id', $obj->getLabel());
        $this->assertSame(7, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getDefaultValue());
        $this->assertSame('[Id Note]', $obj->getNote());
        $this->assertSame('[Id Info]', $obj->getInfo());
        $this->assertSame('', $obj->getInfoDomain());
        $this->assertSame('', $obj->getTextDomain());
        $this->assertSame('Id', $obj->getPlaceholder());
        $this->assertSame('', $obj->getMaxLength());
        $this->assertSame('', $obj->getRows());
        $this->assertSame('', $obj->getCols());
        $this->assertSame(0, $obj->isReadonly());
        $this->assertSame(0, $obj->isDisabled());
        $this->assertSame('', $obj->getClassName());
        $this->assertSame(1, $obj->isPrimary());
        $this->assertSame(1, $obj->isIdentity());
        $this->assertSame('', $obj->getDataCmd());
        $this->assertSame(9, $obj->getMetaId());
        $this->assertSame(1, $obj->getPrimaryLength());
        $this->assertSame('', $obj->getOptionsText());
        $this->assertSame('', $obj->getNoteDomain());
        $this->assertSame(0, $obj->getHasNote());
        $this->assertSame(0, $obj->getHasInfo());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('dev_element')
            ->delete()->where('element_id=?', 15)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('dev_element')
            ->delete()->where('element_id=?', 15)->execute();
    }
}