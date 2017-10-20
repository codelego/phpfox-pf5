<?php

namespace Neutron\Core\Model;

class I18nLocaleTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nLocale(['locale_id' => 'en', 'name' => 'English (US)', 'native_name' => 'English US', 'code_6391' => 'en', 'direction_id' => 'ltr', 'is_active' => 1, 'is_default' => 0,]);

        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English US', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testParameters()
    {
        $obj = new I18nLocale();

        // set data
        $obj->setLocaleId('en');
        $obj->setName('English (US)');
        $obj->setNativeName('English US');
        $obj->setCode6391('en');
        $obj->setDirectionId('ltr');
        $obj->setActive(1);
        $obj->setDefault(0);
        // assert same data
        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English US', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testSave()
    {
        $obj = new I18nLocale(['locale_id' => 'en', 'name' => 'English (US)', 'native_name' => 'English US', 'code_6391' => 'en', 'direction_id' => 'ltr', 'is_active' => 1, 'is_default' => 0,]);

        $obj->save();

        /** @var I18nLocale $obj */
        $obj = \Phpfox::model('i18n_locale')
            ->select()->where('locale_id=?', 'en')->first();

        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English US', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('i18n_locale')
            ->delete()->where('locale_id=?', 'en')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('i18n_locale')
            ->delete()->where('locale_id=?', 'en')->execute();
    }
}