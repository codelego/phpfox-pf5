<?php

namespace Neutron\Core\Model;

class I18nCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nCurrency([
            'currency_id' => 'EUR',
            'symbol'      => '€',
            'name'        => 'Euro',
            'sort_order'  => 2,
            'is_default'  => 1,
            'is_active'   => 1,
        ]);

        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
    }

    public function testParameters()
    {
        $obj = new I18nCurrency();

        // set data
        $obj->setId('EUR');
        $obj->setSymbol('€');
        $obj->setName('Euro');
        $obj->setSortOrder(2);
        $obj->setDefault(1);
        $obj->setActive(1);

        // assert same data
        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
    }

    public function testSave()
    {
        $obj = new I18nCurrency([
            'currency_id' => 'EUR',
            'symbol'      => '€',
            'name'        => 'Euro',
            'sort_order'  => 2,
            'is_default'  => 1,
            'is_active'   => 1,
        ]);

        $obj->save();

        /** @var I18nCurrency $obj */
        $obj = _with('i18n_currency')
            ->select()->where('currency_id=?', 'EUR')->first();

        $this->assertSame('i18n_currency', $obj->getModelId());
        $this->assertSame('EUR', $obj->getId());
        $this->assertSame('€', $obj->getSymbol());
        $this->assertSame('Euro', $obj->getName());
        $this->assertSame(2, $obj->getSortOrder());
        $this->assertSame(1, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
    }

    public static function setUpBeforeClass()
    {
        _with('i18n_currency')
            ->delete()->where('currency_id=?', 'EUR')->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('i18n_currency')
            ->delete()->where('currency_id=?', 'EUR')->execute();
    }
}