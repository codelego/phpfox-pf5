<?php
namespace Neutron\Core\Model;

class I18nLocaleTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nLocale(array (  'locale_id' => 'en',  'name' => 'English (US)',  'native_name' => 'English',  'code_6391' => 'en',  'direction_id' => 'ltr',  'is_active' => 1,));

        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());    }

    public function testParameters()
    {
        $obj = new I18nLocale();

        // set data
        $obj->setLocaleId('en');
        $obj->setName('English (US)');
        $obj->setNativeName('English');
        $obj->setCode6391('en');
        $obj->setDirectionId('ltr');
        $obj->setActive(1);
        // assert same data
        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());    }

    public function testSave()
    {
        $obj = new I18nLocale(array (  'locale_id' => 'en',  'name' => 'English (US)',  'native_name' => 'English',  'code_6391' => 'en',  'direction_id' => 'ltr',  'is_active' => 1,));

        $obj->save();

        /** @var I18nLocale $obj */
        $obj = _model('i18n_locale')
            ->select()->where('locale_id=?','en')->first();

        $this->assertSame('i18n_locale', $obj->getModelId());
        $this->assertSame('en', $obj->getLocaleId());
        $this->assertSame('English (US)', $obj->getName());
        $this->assertSame('English', $obj->getNativeName());
        $this->assertSame('en', $obj->getCode6391());
        $this->assertSame('ltr', $obj->getDirectionId());
        $this->assertSame(1, $obj->isActive());    }

    public static function setUpBeforeClass()
    {
        _model('i18n_locale')
            ->delete()->where('locale_id=?','en')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('i18n_locale')
            ->delete()->where('locale_id=?','en')->execute();
    }
}