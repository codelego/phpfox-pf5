<?php
namespace Neutron\Core\Model;

class I18nCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nCurrency(array (  'currency_id' => 'EUR',  'symbol' => '€',  'name' => 'Euro',  'ordering' => 2,  'is_active' => 1,  'is_default' => 0,));

        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getCurrencyId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());    }

    public function testParameters()
    {
        $obj = new I18nCurrency();

        // set data
        $obj->setCurrencyId('EUR');
        $obj->setSymbol('€');
        $obj->setName('Euro');
        $obj->setOrdering(2);
        $obj->setActive(1);
        $obj->setDefault(0);
        // assert same data
        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getCurrencyId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());    }

    public function testSave()
    {
        $obj = new I18nCurrency(array (  'currency_id' => 'EUR',  'symbol' => '€',  'name' => 'Euro',  'ordering' => 2,  'is_active' => 1,  'is_default' => 0,));

        $obj->save();

        /** @var I18nCurrency $obj */
        $obj = _model('i18n_currency')
            ->select()->where('currency_id=?','EUR')->first();

        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getCurrencyId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getOrdering());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isDefault());    }

    public static function setUpBeforeClass()
    {
        _model('i18n_currency')
            ->delete()->where('currency_id=?','EUR')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('i18n_currency')
            ->delete()->where('currency_id=?','EUR')->execute();
    }
}