<?php

namespace Neutron\Core\Model;

class I18nLanguageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nLanguage([
            'language_id'  => 'en',
            'name'         => 'English (US)',
            'native_name'  => 'English',
            'code_6391'    => 'en',
            'direction_id' => 'ltr',
            'is_active'    => 0,
            'is_default'   => 0,
        ]);

        $this->assertSame('i18n_language', $obj->getModelId());
        $this->assertSame('en', $obj->getId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testParameters()
    {
        $obj = new I18nLanguage();

        // set data
        $obj->setId('en');
        $obj->setName('English (US)');
        $obj->setNativeName('English');
        $obj->setCode6391('en');
        $obj->setDirectionId('ltr');
        $obj->setActive(0);
        $obj->setDefault(0);

        // assert same data
        $this->assertSame('i18n_language', $obj->getModelId());
        $this->assertSame('en', $obj->getId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testSave()
    {
        $obj = new I18nLanguage([
            'language_id'  => 'en',
            'name'         => 'English (US)',
            'native_name'  => 'English',
            'code_6391'    => 'en',
            'direction_id' => 'ltr',
            'is_active'    => 0,
            'is_default'   => 0,
        ]);

        $obj->save();

        /** @var I18nLanguage $obj */
        $obj = _with('i18n_language')
            ->select()->where('language_id=?', 'en')->first();

        $this->assertSame('i18n_language', $obj->getModelId());
        $this->assertSame('en', $obj->getId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public static function setUpBeforeClass()
    {
        _with('i18n_language')
            ->delete()->where('language_id=?', 'en')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('i18n_language')
            ->delete()->where('language_id=?', 'en')->execute();
    }
}