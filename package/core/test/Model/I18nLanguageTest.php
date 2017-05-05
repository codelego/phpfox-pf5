<?php

namespace Neutron\Core\Model;


class I18nLanguageTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new I18nLanguage([
            'id'          => 'en',
            'name'        => 'English (US)',
            'native_name' => 'English',
            'code_6391'   => 'en',
            'direction'   => 'ltr',
            'is_active'   => '1',
            'is_default'  => '0',
        ]);

        $this->assertEquals('en', $obj->getId());
        $this->assertEquals('i18n_language', $obj->getModelId());
        $this->assertEquals('English (US)', $obj->getName());
        $this->assertEquals('English (US)', $obj->getTitle());
        $this->assertEquals('English', $obj->getNativeName());
        $this->assertEquals('1', $obj->isActive());
        $this->assertEquals('0', $obj->isDefault());
        $this->assertEquals('ltr', $obj->getDirection());
    }

    public function testSave()
    {
        $obj = new I18nLanguage([
            'id'          => 'test_language',
            'name'        => '[test name]',
            'native_name' => '[native_name]',
            'code_6391'   => '[test_code]',
            'direction'   => 'rtl',
            'is_active'   => '1',
            'is_default'  => '0',
        ]);

        $obj->save();

        /** @var I18nLanguage $entry */
        $entry = \Phpfox::with('i18n_language')
            ->findById('test_language');

        $this->assertEquals('test_language', $obj->getId());
        $this->assertEquals('i18n_language', $obj->getModelId());
        $this->assertEquals('[test name]', $obj->getName());
        $this->assertEquals('[test name]', $obj->getTitle());
        $this->assertEquals('[test_code]', $obj->getCode6391());
        $this->assertEquals('[native_name]', $obj->getNativeName());
        $this->assertEquals('1', $obj->isActive());
        $this->assertEquals('0', $obj->isDefault());
        $this->assertEquals('rtl', $obj->getDirection());

        $entry->setName('[test name 1]');
        $entry->setNativeName('[native_name 1]');
        $entry->setActive('0');
        $entry->setDefault('0');
        $entry->setDirection('ltr');
        $entry->setCode6391('[test_code_1]');

        $entry->save();

        $this->assertEquals('test_language', $entry->getId());
        $this->assertEquals('i18n_language', $entry->getModelId());
        $this->assertEquals('[test name 1]', $entry->getName());
        $this->assertEquals('[test name 1]', $entry->getTitle());
        $this->assertEquals('[native_name 1]', $entry->getNativeName());
        $this->assertEquals('0', $entry->isActive());
        $this->assertEquals('0', $entry->isDefault());
        $this->assertEquals('ltr', $entry->getDirection());

        /** @var I18nLanguage $entry */
        $entry = \Phpfox::with('i18n_language')
            ->findById('test_language');

        $entry->delete();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')
            ->delete(':i18n_language')
            ->where('id=?', 'test_language')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':i18n_language')
            ->where('id=?', 'test_language')
            ->execute();
    }
}
